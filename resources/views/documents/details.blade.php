<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Détails du Document - {{ $document->titre }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 50%, #e8ddd0 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(90, 124, 122, 0.1);
            position: relative;
            overflow: hidden;
        }
        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(90, 124, 122, 0.03), transparent);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        .header h1 {
            color: #2c3e3c;
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 1px;
        }
        .document-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .document-table th,
        .document-table td {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(90, 124, 122, 0.1);
            text-align: left;
            font-weight: 500;
            color: #2c3e3c;
        }
        .document-table th {
            background-color: rgba(90, 124, 122, 0.1);
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .document-table tr:last-child td {
            border-bottom: none;
        }
        .document-description {
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid rgba(90, 124, 122, 0.1);
        }
        .description-title {
            font-size: 18px;
            color: #2c3e3c;
            margin-bottom: 15px;
            font-weight: 500;
        }
        .description-text {
            color: #4a5a58;
            line-height: 1.6;
            font-size: 15px;
        }
        .actions-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid rgba(90, 124, 122, 0.1);
            position: relative;
            z-index: 1;
        }
        .action-btn {
            padding: 15px 20px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }
        .preview-section {
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(90, 124, 122, 0.1);
        }
        .preview-title {
            font-size: 18px;
            color: #2c3e3c;
            margin-bottom: 15px;
            font-weight: 500;
        }
        .preview-placeholder {
            background: rgba(90, 124, 122, 0.1);
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            color: #6b7f7d;
            font-style: italic;
        }
        @media (max-width: 768px) {
            .container { padding: 20px; }
            .header { flex-direction: column; gap: 20px; }
            .header h1 { font-size: 24px; text-align: center; }
            .actions-section { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Détails du Document</h1>
    </div>

    <h2 class="document-title">{{ $document->titre }}</h2>

    <table class="document-table">
        <tbody>
        <tr><th>Catégorie</th><td>{{ $document->categorie ?? 'Non spécifiée' }}</td></tr>
<tr><th>Date d'ajout</th><td>{{ $document->created_at->format('d/m/Y à H:i') }}</td></tr>
<tr><th>Dernière modification</th><td>{{ $document->updated_at->format('d/m/Y à H:i') }}</td></tr>
<tr>
    <th>Ajouté par</th>
    <td>
        {{ $document->user->name ?? 'Utilisateur inconnu' }} 
    </td>
</tr>
<tr><th>Nom du fichier</th><td>{{ $document->nom_fichier ?? 'Non disponible' }}</td></tr>
<tr><th>Statut</th><td>{{ $document->is_archived ? 'Archivé' : 'Actif' }}</td></tr>
        
    </tbody>
    </table>

    @if($document->description)
    <div class="document-description">
        <h3 class="description-title">Description</h3>
        <p class="description-text">{{ $document->description }}</p>
    </div>
    @endif

    @if($document->ocr_text)
    <div class="document-description">
        <h3 class="description-title">Texte extrait (OCR)</h3>
        <pre class="description-text" style="white-space: pre-wrap;">{{ $document->ocr_text }}</pre>
    </div>
    @endif

    @if($document->chemin_fichier)
    <div class="preview-section">
        <h3 class="preview-title">Aperçu du document</h3>
        <div class="preview-placeholder">Aperçu non disponible pour ce type de fichier</div>
    </div>
    @endif

    <div class="actions-section">
        <a href="{{ route('documents.download', $document) }}" class="action-btn">📥 Télécharger</a>
        <a href="{{ route('documents.edit', $document) }}" class="action-btn">✏️ Modifier</a>
        <a href="{{ route('documents.share.form', $document) }}" class="action-btn">📧 Partager</a>
        @if($document->ocr_text && $document->ocr_file_path)
        <a href="{{ route('documents.downloadOcr', $document) }}" class="action-btn">📄 Télécharger le texte OCR</a>
        @endif
        <form action="{{ route('documents.archive', $document) }}" method="POST" style="display:inline;" onsubmit="return confirm('Archiver ce document ?')">
            @csrf
            @method('PATCH')
            <button type="submit" class="action-btn">{{ $document->is_archived ? '📦 Désarchiver' : '📦 Archiver' }}</button>
        </form>
        <form action="{{ route('documents.destroy', $document) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer définitivement ce document ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn">🗑️ Supprimer</button>
        </form>
        <a href="{{ route('documents.index') }}" class="action-btn">Retour</a>
    </div>
</div>

<script>
function partagerDocument(documentId) {
    let email = prompt("Entrez l'adresse email pour partager le document :");
    if (!email) return alert("Email requis.");

    fetch(`/documents/${documentId}/share`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ email: email }),
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => alert("Erreur lors du partage : " + error));
}
</script>
</body>
</html>
