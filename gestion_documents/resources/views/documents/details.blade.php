<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Document - {{ $document->titre }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
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

        .back-btn {
            padding: 12px 20px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .document-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .document-title {
            font-size: 28px;
            color: #2c3e3c;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .document-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .meta-item {
            background: rgba(90, 124, 122, 0.05);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #5a7c7a;
        }

        .meta-label {
            font-size: 12px;
            color: #6b7f7d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .meta-value {
            font-size: 16px;
            color: #2c3e3c;
            font-weight: 500;
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

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            box-shadow: 0 12px 35px rgba(220, 53, 69, 0.4);
        }

        .file-info {
            background: rgba(90, 124, 122, 0.05);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .file-info h3 {
            color: #2c3e3c;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .file-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .file-detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(90, 124, 122, 0.1);
        }

        .detail-label {
            font-weight: 500;
            color: #6b7f7d;
        }

        .detail-value {
            color: #2c3e3c;
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
            .container {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                gap: 20px;
            }

            .header h1 {
                font-size: 24px;
                text-align: center;
            }

            .document-meta {
                grid-template-columns: 1fr;
            }

            .actions-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Détails du Document</h1>
            <a href="{{ route('documents.index') }}" class="back-btn">
                ← Retour à la liste
            </a>
        </div>

        <div class="document-card">
            <h2 class="document-title">{{ $document->titre }}</h2>
            
            <div class="document-meta">
                <div class="meta-item">
                    <div class="meta-label">Catégorie</div>
                    <div class="meta-value">{{ $document->categorie ?? 'Non spécifiée' }}</div>
                </div>
                
                <div class="meta-item">
                    <div class="meta-label">Date d'ajout</div>
                    <div class="meta-value">{{ $document->created_at->format('d/m/Y à H:i') }}</div>
                </div>
                
                <div class="meta-item">
                    <div class="meta-label">Dernière modification</div>
                    <div class="meta-value">{{ $document->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
                
                <div class="meta-item">
                    <div class="meta-label">Ajouté par</div>
                    <div class="meta-value">{{ $document->user->name ?? 'Utilisateur inconnu' }}</div>
                </div>
            </div>

            @if($document->description)
            <div class="document-description">
                <h3 class="description-title">Description</h3>
                <p class="description-text">{{ $document->description }}</p>
            </div>
            @endif

            <div class="file-info">
                <h3>Informations du fichier</h3>
                <div class="file-details">
                    <div class="file-detail-item">
                        <span class="detail-label">Nom du fichier :</span>
                        <span class="detail-value">{{ $document->nom_fichier ?? 'Non disponible' }}</span>
                    </div>
                    <div class="file-detail-item">
                        <span class="detail-label">Type de fichier :</span>
                        <span class="detail-value">{{ $document->type_fichier ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="file-detail-item">
                        <span class="detail-label">Taille :</span>
                        <span class="detail-value">{{ $document->taille_fichier ? number_format($document->taille_fichier / 1024, 2) . ' KB' : 'Non disponible' }}</span>
                    </div>
                    <div class="file-detail-item">
                        <span class="detail-label">Statut :</span>
                        <span class="detail-value">{{ $document->is_archived ? 'Archivé' : 'Actif' }}</span>
                    </div>
                </div>
            </div>

            @if($document->chemin_fichier)
            <div class="preview-section">
                <h3 class="preview-title">Aperçu du document</h3>
                <div class="preview-placeholder">
                    Aperçu non disponible pour ce type de fichier
                    <!-- Ici vous pouvez ajouter une logique pour afficher un aperçu selon le type de fichier -->
                </div>
            </div>
            @endif
        </div>

        <div class="actions-section">
            <a href="{{ route('documents.download', $document) }}" class="action-btn">
                📥 Télécharger
            </a>
            
            <a href="{{ route('documents.edit', $document) }}" class="action-btn">
                ✏️ Modifier
            </a>
            
            <form action="{{ route('documents.archive', $document) }}" method="POST" style="display:inline;" onsubmit="return confirm('Archiver ce document ?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="action-btn">
                    📦 {{ $document->is_archived ? 'Désarchiver' : 'Archiver' }}
                </button>
            </form>
            
            <form action="{{ route('documents.destroy', $document) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer définitivement ce document ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn btn-danger">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    </div>
</body>
</html>