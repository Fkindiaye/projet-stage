<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentShare;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentPartageMail;


class DocumentController extends Controller
{
    // 1. Liste des documents
    public function index(Request $request)
    {
        $query = Document::query();

        // Recherche et filtre
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        $documents = $query->latest()->get();

        return view('documents.index', compact('documents'));
    }

    // 2. Formulaire d’ajout
    public function create()
    {
        return view('documents.create');
    }

    // 3. Enregistrer le document
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,docx,jpg,jpeg,png|max:5120', // max 5 Mo
        ]);

        $path = $request->file('file')->store('documents');

        Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'file_path' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès.');
    }

    // 4. Afficher un document
    public function show(Document $document)
    {
        return response()->file(storage_path("app/" . $document->file_path));
    }

    // 5. Formulaire de modification
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    // 6. Mettre à jour le document
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:100',
            // Pour le fichier, vous pourriez gérer le remplacement du fichier ici si besoin
        ]);

        $document->update($request->only(['titre', 'description', 'categorie']));

        return redirect()->route('documents.index')->with('success', 'Document modifié');
    }

    // 7. Supprimer un document (soft delete = archiver)
    public function archive($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();  // Suppression douce, si le modèle utilise SoftDeletes

        return redirect()->route('documents.index')->with('success', 'Document archivé avec succès.');
    }

    // Voir les documents archivés (soft deleted)
    public function archives()
    {
        $documents = Document::onlyTrashed()->get();
        return view('documents.archives', compact('documents'));
    }

    // Restaurer un document archivé
    public function restore($id)
    {
        $document = Document::withTrashed()->findOrFail($id);
        $document->restore();
    
        return redirect()->route('documents.index')->with('success', 'Document désarchivé avec succès.');
    }
    

    // 8. Télécharger un document
    public function download(Document $document)
{
    if (!$document->file_path) {
        return redirect()->back()->with('error', 'Aucun fichier à télécharger pour ce document.');
    }

    if (!Storage::exists($document->file_path)) {
        return redirect()->back()->with('error', 'Fichier introuvable sur le serveur.');
    }

    return Storage::download($document->file_path);
}

public function partager(Request $request)
{
    $request->validate([
        'document_id' => 'required|exists:documents,id',
        'email' => 'required|email',
    ]);

    $document = Document::findOrFail($request->document_id);

    // Enregistrer le partage
    DocumentShare::create([
        'document_id' => $document->id,
        'email' => $request->email,
    ]);

    // Envoyer un email
    Mail::to($request->email)->send(new DocumentPartageMail($document));

    return back()->with('success', 'Document partagé avec succès !');
}
public function getDetails($id)
{
    $document = Document::findOrFail($id);
    
    return response()->json([
        'success' => true,
        'data' => [
            'id' => $document->id,
            'name' => $document->name,
            'type' => $document->type,
            'size' => $document->size,
            'created_at' => $document->created_at->format('d/m/Y H:i'),
            'updated_at' => $document->updated_at->format('d/m/Y H:i'),
            'description' => $document->description,
            'path' => $document->path,
            // Ajoutez d'autres champs selon vos besoins
        ]
    ]);
}

public function getMultipleDetails(Request $request)
{
    $ids = $request->input('document_ids');
    $documents = Document::whereIn('id', $ids)->get();
    
    return response()->json([
        'success' => true,
        'data' => $documents->map(function($doc) {
            return [
                'id' => $doc->id,
                'name' => $doc->name,
                'type' => $doc->type,
                'size' => $doc->size,
                'created_at' => $doc->created_at->format('d/m/Y H:i'),
                'description' => $doc->description,
            ];
        })
    ]);
}

}
