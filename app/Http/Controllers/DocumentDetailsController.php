<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentDetailsController extends Controller
{
    /**
     * Afficher les détails d'un document spécifique
     */
    public function show($id)
    {
        $document = Document::with('user')->findOrFail($id);
        
        // Vérifier si l'utilisateur a le droit de voir ce document
        // (ajustez selon vos règles métier)
        if ($document->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé à ce document');
        }
        
        return view('documents.details', compact('document'));
    }
    
    /**
     * Afficher les détails de plusieurs documents sélectionnés
     */
    public function showMultiple(Request $request)
    {
        $documentIds = $request->input('document_ids', []);
        
        if (empty($documentIds)) {
            return redirect()->route('documents.index')
                           ->with('error', 'Aucun document sélectionné');
        }
        
        // Convertir en array si c'est une chaîne JSON
        if (is_string($documentIds)) {
            $documentIds = json_decode($documentIds, true);
        }
        
        $documents = Document::with('user')
                           ->whereIn('id', $documentIds)
                           ->get();
        
        // Vérifier les droits d'accès pour chaque document
        $documents = $documents->filter(function ($document) {
            return $document->user_id === Auth::id() || Auth::user()->hasRole('admin');
        });
        
        if ($documents->isEmpty()) {
            return redirect()->route('documents.index')
                           ->with('error', 'Aucun document accessible trouvé');
        }
        
        return view('documents.details-multiple', compact('documents'));
    }
    
    /**
     * Afficher un aperçu/résumé de tous les documents
     */
    public function overview()
    {
        $user = Auth::user();
        
        // Statistiques générales
        $totalDocuments = Document::count();
        $userDocuments = Document::where('user_id', $user->id)->count();
        $recentDocuments = Document::where('created_at', '>=', now()->subDays(7))->count();
        $archivedDocuments = Document::where('is_archived', true)->count();
        
        // Documents par catégorie
        $documentsByCategory = Document::select('categorie')
                                     ->selectRaw('count(*) as count')
                                     ->groupBy('categorie')
                                     ->get();
        
        // Documents récents
        $latestDocuments = Document::with('user')
                                 ->orderBy('created_at', 'desc')
                                 ->limit(10)
                                 ->get();
        
        return view('documents.overview', compact(
            'totalDocuments',
            'userDocuments', 
            'recentDocuments',
            'archivedDocuments',
            'documentsByCategory',
            'latestDocuments'
        ));
    }
}