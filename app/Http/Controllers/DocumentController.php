<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentShare;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentPartageMail;
use thiagoalessio\TesseractOCR\TesseractOCR;

class DocumentController extends Controller
{
    // 1. Liste des documents
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Document::query();

        // Exclure les documents archivés
        $query->where('is_archived', false);

        if (!$user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('partages', function ($q2) use ($user) {
                      $q2->where('destinataire_id', $user->id);
                  });
            });
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('categorie', 'like', '%' . $request->search . '%');
            });
        }

        $documents = $query->with('user')->latest()->get();
        return view('documents.index', compact('documents'));
    }

    // 2. Formulaire d’ajout
    public function create()
    {
        return view('documents.create');
    }

    // 3. Enregistrer un document
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:100',
            'fichier' => 'required|file|mimes:pdf,doc,docx,txt,jpg,png|max:20480',
        ]);

        $file = $request->file('fichier');
        $path = $file->store('documents');
        $ocrText = null;
        $txtPath = null;

        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $ocrText = (new TesseractOCR(storage_path('app/' . $path)))
                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe')
                ->run();

            $txtFileName = uniqid('ocr_') . '.txt';
            $txtPath = 'documents/' . $txtFileName;
            Storage::put($txtPath, $ocrText);
        }

        Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'file_path' => $path,
            'nom_fichier' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
            'ocr_text' => $ocrText,
            'ocr_file_path' => $txtPath
        ]);

        return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès.');
    }

    // 4. Afficher un document (le fichier)
    public function show(Document $document)
    {
        $filePath = storage_path('app/' . $document->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'Fichier introuvable : ' . $document->file_path);
        }

        return response()->file($filePath);
    }

    // 5. Afficher les détails (vue Blade)
    public function details($id)
    {
        $document = Document::with('user')->findOrFail($id);
        return view('documents.details', compact('document'));
    }

    // 6. Mettre à jour un document
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:100',
        ]);

        $document->update($request->only(['titre', 'description', 'categorie']));

        return redirect()->route('documents.index')->with('success', 'Document modifié.');
    }

    // 7. Archiver un document
    public function archive($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document archivé avec succès.');
    }

    // 8. Voir les documents archivés
    public function archives()
    {
        $documents = Document::onlyTrashed()->get();
        return view('documents.archives', compact('documents'));
    }

    // 9. Restaurer un document archivé
    public function restore($id)
    {
        $document = Document::withTrashed()->findOrFail($id);
        $document->restore();
        return redirect()->route('documents.index')->with('success', 'Document désarchivé avec succès.');
    }

    // 10. Archiver plusieurs documents
    public function archiveMultiple(Request $request)
    {
        $ids = json_decode($request->input('document_ids'), true);

        if (is_array($ids) && count($ids) > 0) {
            Document::whereIn('id', $ids)->update(['is_archived' => true]);
            return redirect()->route('documents.index')->with('success', 'Documents archivés avec succès.');
        }

        return redirect()->route('documents.index')->with('error', 'Aucun document sélectionné.');
    }

    // 11. Télécharger un document
    public function download(Document $document)
{
    if (!$document->file_path || !Storage::exists($document->file_path)) {
        return redirect()->back()->with('error', 'Fichier introuvable ou inexistant.');
    }

    // ✅ Incrémenter le compteur de téléchargements
    $document->increment('downloads');

    return Storage::download($document->file_path);
}

    // 12. Partager un document
    public function share(Request $request, Document $document)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $content = "Bonjour,\n\nLe document « {$document->titre} » a été partagé avec vous via la plateforme.";

        Mail::raw($content, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Document partagé');
        });

        return response()->json(['message' => 'Document partagé avec succès.']);
    }

    public function showShareForm($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.share', compact('document'));
    }

   public function shareDocument(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $document = Document::findOrFail($id);
    $email = $request->input('email');

    // Récupérer le chemin complet du fichier
    $filePath = storage_path('app/' . $document->file_path);

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'Le fichier du document est introuvable.');
    }

    // Envoyer l’e-mail avec le fichier en pièce jointe
    \Mail::send([], [], function ($message) use ($email, $document, $filePath) {
        $message->to($email)
                ->subject('Document partagé : ' . $document->titre)
                ->text("Bonjour,\n\nVeuillez trouver ci-joint le document « {$document->titre} » partagé avec vous.")
                ->attach($filePath, [
                    'as' => $document->titre . '.' . pathinfo($filePath, PATHINFO_EXTENSION),
                    'mime' => mime_content_type($filePath),
                ]);
    });

    // 🔁 Met à jour is_shared à true
    $document->update(['is_shared' => true]);

    return redirect()->route('documents.details', $id)->with('success', 'Document envoyé avec succès à ' . $email . ' en pièce jointe.');
}


    // 14. Supprimer plusieurs documents
    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('document_ids', []);
        if (is_array($ids)) {
            Document::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Documents supprimés avec succès.']);
        }
        return response()->json(['message' => 'Aucun document sélectionné.'], 400);
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    // 15. Partager plusieurs documents
    public function shareMultiple(Request $request)
    {
        $ids = $request->input('document_ids', []);
        $email = $request->input('email');

        $documents = Document::whereIn('id', $ids)->get();
        $content = "Voici les documents partagés :\n\n";
        foreach ($documents as $doc) {
            $content .= "- " . $doc->titre . "\n";
        }

        \Mail::raw($content, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Documents partagés via la plateforme');
        });

        return response()->json(['message' => 'Documents partagés avec succès.']);
    }

    public function stats()
{
    $userId = auth()->id(); 

    $totalDocuments = Document::where('user_id', $userId)->count();
    $sharedDocuments = Document::where('user_id', $userId)->where('is_shared', true)->count();
    $archivedDocuments = Document::where('user_id', $userId)->where('is_archived', true)->count();

    return view('documents.stats', compact('totalDocuments', 'sharedDocuments', 'archivedDocuments'));
}


    public function adminStats()
    {
        $totalDocuments    = Document::count();
        $sharedDocuments   = Document::where('is_shared', true)->count();
        $archivedDocuments = Document::where('is_archived', true)->count();
        $deletedDocuments  = Document::onlyTrashed()->count();
        $totalDownloads    = Document::sum('downloads');

        return view('admin.stats', compact(
            'totalDocuments',
            'sharedDocuments',
            'archivedDocuments',
            'deletedDocuments',
            'totalDownloads'
        ));
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

         $document->forceDelete();

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès.');
    }

    public function downloadOcr(Document $document)
    {
        $path = $document->ocr_file_path;

        if (!$path || !Storage::exists($path)) {
            return redirect()->back()->with('error', 'Fichier OCR non disponible.');
        }

        return Storage::download($path, 'texte_extrait_' . $document->id . '.txt');
    }

    public function mesArchives()
{
    $user = auth()->user();
    $documents = Document::where('user_id', $user->id)
                         ->where('is_archived', true)
                         ->get();

    return view('documents.mes_archives', compact('documents'));
}

public function desarchiver($id)
{
    $document = Document::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

    $document->is_archived = false;
    $document->save();

    return redirect()->route('documents.mes_archives')->with('success', 'Document désarchivé avec succès.');
}
}
