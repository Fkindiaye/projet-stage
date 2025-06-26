<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails des Documents Sélectionnés</title>
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
            max-width: 1200px;
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

        .summary-card {
            background: rgba(90, 124, 122, 0.05);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .summary-title {
            font-size: 20px;
            color: #2c3e3c;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border-left: 4px solid #5a7c7a;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e3c;
        }

        .stat-label {
            font-size: 12px;
            color: #6b7f7d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .document-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(90, 124, 122, 0.1);
        }

        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .document-title {
            font-size: 18px;
            color: #2c3e3c;
            margin-bottom: 15px;
            font-weight: 500;
            line-height: 1.3;
        }

        .document-meta {
            margin-bottom: 20px;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .meta-label {
            color: #6b7f7d;
            font-weight: 500;
        }

        .meta-value {
            color: #2c3e3c;
        }

        .document-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 8px 12px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .bulk-actions {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .bulk-actions h3 {
            color: #2c3e3c;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .bulk-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .bulk-btn {
            padding: 12px 18px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
        }

        .bulk-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
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

            .documents-grid {
                grid-template-columns: 1fr;
            }

            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .bulk-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Détails des Documents ({{ $documents->count() }})</h1>
            <a href="{{ route('documents.index') }}" class="back-btn">
                ← Retour à la liste
            </a>
        </div>

        <div class="summary-card">
            <h3 class="summary-title">Résumé de la sélection</h3>
            <div class="summary-stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $documents->count() }}</div>
                    <div class="stat-label">Documents sélectionnés</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $documents->groupBy('categorie')->count() }}</div>
                    <div class="stat-label">Catégories différentes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $documents->where('is_archived', false)->count() }}</div>
                    <div class="stat-label">Documents actifs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ number_format($documents->sum('taille_fichier') / 1024, 2) }} KB</div>
                    <div class="stat-label">Taille totale</div>
                </div>