<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Documents</title>
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            border: 1px solid rgba(90, 124, 122, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 40px);
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

        /* SECTION SUPÉRIEURE - TITRE ET RECHERCHE */
        .top-section {
            position: relative;
            z-index: 1;
            margin-bottom: 30px;
        }

        .container h1 {
            text-align: center;
            color: #2c3e3c;
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(212, 237, 218, 0.3);
        }

        /* Section de recherche */
        .search-section {
            margin-bottom: 20px;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr auto;
            gap: 15px;
            align-items: center;
        }

        .search-input {
            padding: 15px 20px;
            border: 2px solid rgba(90, 124, 122, 0.2);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: #5a7c7a;
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(90, 124, 122, 0.15);
        }

        .search-input::placeholder {
            color: #6b7f7d;
            font-weight: 400;
        }

        .search-btn {
            padding: 15px 25px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .search-results-info {
            color: #6b7f7d;
            font-size: 14px;
            margin-top: 10px;
        }

        /* SECTION CENTRALE - TABLEAU (FLEXIBLE) */
        .table-section {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .table-container {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .documents-table thead {
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .documents-table th,
        .documents-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(90, 124, 122, 0.1);
        }

        .documents-table th {
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .documents-table tr:hover {
            background: rgba(90, 124, 122, 0.05);
        }

        .table-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .table-btn,
        .btn-download,
        .btn-edit,
        .btn-archive,
        .btn-share,
        .btn-delete {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            position: relative;
        }

        .table-btn:hover,
        .btn-download:hover,
        .btn-edit:hover,
        .btn-archive:hover,
        .btn-share:hover,
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        /* Tooltip pour les boutons d'action du tableau */
        .table-btn::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            z-index: 1000;
        }

        .table-btn:hover::after {
            opacity: 1;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7f7d;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2c3e3c;
        }

        /* SECTION INFÉRIEURE - BOUTONS D'ACTION */
        .bottom-section {
            position: relative;
            z-index: 1;
            border-top: 2px solid rgba(90, 124, 122, 0.1);
            padding-top: 20px;
            margin-top: auto;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .action-btn {
            padding: 15px 20px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .action-btn:active {
            transform: translateY(-1px);
        }

        .dashboard-btn {
            padding: 12px 20px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.5px;
            width: fit-content;
            margin: 0 auto;
        }

        .dashboard-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
                width: calc(100% - 20px);
            }

            .container h1 {
                font-size: 28px;
                margin-bottom: 20px;
            }

            .search-form {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .action-buttons {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .table-container {
                overflow-x: auto;
            }

            .documents-table {
                min-width: 700px;
            }

            .table-actions {
                gap: 4px;
            }

            .table-btn {
                padding: 6px 8px;
                min-width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .action-btn {
                padding: 12px 15px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }

            .search-input {
                padding: 12px 15px;
                font-size: 14px;
            }

            .search-btn {
                padding: 12px 20px;
                font-size: 13px;
            }
        }

        /* Animation d'entrée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            animation: fadeInUp 0.8s ease;
        }

        .top-section {
            animation: fadeInUp 0.6s ease forwards;
        }

        .table-section {
            animation: fadeInUp 0.7s ease forwards;
        }

        .bottom-section {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <!-- SECTION SUPÉRIEURE - TITRE ET RECHERCHE -->
        <div class="top-section">
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h1>Liste des Documents</h1>

<!-- Section de recherche -->
<div class="search-section">
    <form action="{{ route('documents.index') }}" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un document par titre ou auteur..." class="search-input">
        <button type="submit" class="search-btn">🔍 Rechercher</button>
    </form>

    @if(request('search'))
        <div class="search-results-info">
            Résultats pour la recherche : <strong>{{ request('search') }}</strong>
        </div>
    @endif
</div>

<!-- Section centrale - tableau -->
<div class="table-section">
    <div class="table-container">
        <table class="documents-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes()"></th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Date d'ajout</th>
                    <th>Ajouté par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $doc)
                    <tr>
                        <td><input type="checkbox" class="doc-checkbox" value="{{ $doc->id }}"></td>
                        <td>{{ $doc->titre }}</td>
                        <td>
                            @if(in_array(strtolower($doc->categorie), ['rapport', 'guide', 'règlement']))
                                {{ ucfirst($doc->categorie) }}
                            @else
                                Autre
                            @endif
                        </td>
                        <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td>
                            {{ $doc->user->name ?? 'N/A' }} 
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('documents.details', $doc->id) }}" class="table-btn btn-view" title="Voir les détails">Voir</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <h3>Aucun document trouvé</h3>
                                <p>Commencez par ajouter votre premier document ou modifiez vos critères de recherche.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Section inférieure - boutons d'action -->
<div class="bottom-section">
    <div class="action-buttons">
        <a href="{{ route('documents.create') }}" class="action-btn">➕ Ajouter Document</a>
        <button class="action-btn" onclick="archiveSelected()">📦 Archiver Sélection</button>
    </div>
    <a href="{{ route('dashboard') }}" class="dashboard-btn">🏠 Retour au Dashboard</a>
</div>

    <script>
        function toggleAllCheckboxes() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.doc-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }

        function getSelectedDocuments() {
            return Array.from(document.querySelectorAll('.doc-checkbox:checked')).map(cb => cb.value);
        }

        function shareDocument() {
            const selected = getSelectedDocuments();
            if (selected.length === 0) {
                alert("Veuillez sélectionner au moins un document à partager.");
                return;
            }

            const email = prompt("Entrez l'adresse e-mail du destinataire :");
            if (!email) return;

            fetch('/documents/share-multiple', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    document_ids: selected,
                    email: email
                })
            }).then(response => {
                if (response.ok) {
                    alert("Documents partagés avec succès !");
                } else {
                    alert("Erreur lors du partage.");
                }
            });
        }

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
function archiveSelected() {
    const selected = getSelectedDocuments();
    if (selected.length === 0) {
        alert("Veuillez sélectionner au moins un document à archiver.");
        return;
    }

    if (confirm(`Êtes-vous sûr de vouloir archiver ${selected.length} document(s) ?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/documents/archive-multiple';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrfToken);

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PUT';
        form.appendChild(methodField);

        const documentsField = document.createElement('input');
        documentsField.type = 'hidden';
        documentsField.name = 'document_ids';
        documentsField.value = JSON.stringify(selected);
        form.appendChild(documentsField);

        document.body.appendChild(form);
        form.submit();
    }
}

        function deleteSelected() {
            const selected = getSelectedDocuments();
            if (selected.length === 0) {
                alert("Veuillez sélectionner au moins un document à supprimer.");
                return;
            }

            if (confirm("Êtes-vous sûr de vouloir supprimer ces documents ?")) {
                fetch('/documents/delete-multiple', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ document_ids: selected })
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert("Erreur lors de la suppression.");
                    }
                });
            }
        }
    </script>
</body>
</html>