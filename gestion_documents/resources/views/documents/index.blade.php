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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 400px;
            max-width: 90vw;
            border: 1px solid rgba(90, 124, 122, 0.1);
            position: relative;
            overflow: hidden;
        }

        .login-box::before {
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

        .login-box h2 {
            text-align: center;
            color: #2c3e3c;
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .error-message {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            position: relative;
            z-index: 1;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
            z-index: 1;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(90, 124, 122, 0.2);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #5a7c7a;
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(90, 124, 122, 0.15);
        }

        .form-group input::placeholder {
            color: #6b7f7d;
            font-weight: 400;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .register-link {
            margin-top: 25px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .register-link {
            color: #6b7f7d;
            font-size: 14px;
        }

        .register-link a {
            color: #5a7c7a;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .register-link a:hover {
            background: rgba(90, 124, 122, 0.1);
            color: #4a6c6a;
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

        .login-box {
            animation: fadeInUp 0.8s ease;
        }

        .form-group {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        .form-group:nth-child(5) { animation-delay: 0.4s; }
        .submit-btn { animation-delay: 0.5s; }

        /* Responsive */
        @media (max-width: 480px) {
            .login-box {
                padding: 30px 25px;
                width: 100%;
                margin: 0 10px;
            }
            
            .login-box h2 {
                font-size: 24px;
                margin-bottom: 25px;
            }
            
            .form-group input {
                padding: 12px 15px;
                font-size: 15px;
            }
            
            .submit-btn {
                padding: 14px;
                font-size: 15px;
            }
        }

        /* Effet de focus sur le formulaire */
        .login-box:hover {
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
        }

        /* NOUVELLES CLASSES POUR LA STRUCTURE */
        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 1200px;
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

        .container h1 {
            text-align: center;
            color: #2c3e3c;
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 40px;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
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
            gap: 8px;
            letter-spacing: 0.5px;
        }

        .dashboard-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .dashboard-btn:active {
            transform: translateY(-1px);
        }

        /* Section de recherche */
        .search-section {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
            gap: 15px;
            align-items: end;
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

        .search-select {
            padding: 15px 20px;
            border: 2px solid rgba(90, 124, 122, 0.2);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
            cursor: pointer;
        }

        .search-select:focus {
            border-color: #5a7c7a;
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(90, 124, 122, 0.15);
        }

        /* Tableau */
        .table-container {
            position: relative;
            z-index: 1;
            overflow-x: auto;
            margin-bottom: 30px;
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

        .table-btn {
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
        }

        .btn-download {
            background: linear-gradient(135deg, #5a7c7a, #4a6c6a);
        }

        .btn-edit {
            background: linear-gradient(135deg, #5a7c7a, #4a6c6a);
        }

        .btn-archive {
            background: linear-gradient(135deg, #5a7c7a, #4a6c6a);
        }

        .btn-delete {
            background: linear-gradient(135deg, #5a7c7a, #4a6c6a);
        }

        .table-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(90, 124, 122, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7f7d;
            position: relative;
            z-index: 1;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2c3e3c;
        }

        /* Section des boutons d'action - Placée en bas */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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

        .search-btn {
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

        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        /* Bouton d'archivage dans les actions principales */
        .action-btn.btn-archive-selected {
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
        }

        .action-btn.btn-archive-selected:hover {
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
        }

        /* Responsive pour les boutons d'action */
        @media (max-width: 768px) {
            .container h1 {
                font-size: 28px;
            }

            .action-buttons {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .search-form {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .action-btn {
                padding: 12px 15px;
                font-size: 12px;
            }

            .table-container {
                overflow-x: scroll;
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
        }

        @media (max-width: 480px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }

        /* Tooltip pour les boutons d'action du tableau */
        .table-btn {
            position: relative;
        }

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

        /* Alerte de succès stylisée */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(212, 237, 218, 0.3);
        }
    </style>
</head>
<body>
<div class="container">
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

    <!-- Header avec titre -->
    <h1>Liste des Documents</h1>

    <!-- Section de recherche et filtres -->
    <div class="search-section">
       
    <form action="{{ route('documents.index') }}" method="GET" class="search-form">
    <input type="text" name="query" value="{{ request('query') }}" placeholder="Rechercher un document par titre ou auteur...">
    <button type="submit">Rechercher</button>
</form>

@if(request('query'))
    <p>Résultats pour la recherche : <strong>{{ request('query') }}</strong></p>
@endif

    </div>

    <!-- Tableau des documents -->
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
                    <td>{{ $doc->categorie }}</td>
                    <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                    <td>{{ $doc->user->name ?? 'N/A' }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('documents.download', $doc) }}" class="table-btn btn-download" title="Télécharger">📥</a>
                            <a href="{{ route('documents.edit', $doc) }}" class="table-btn btn-edit" title="Modifier">✏️</a>
                            
                            <!-- Nouveau bouton d'archivage -->
                            <form action="{{ route('documents.archive', $doc) }}" method="POST" style="display:inline;" onsubmit="return confirm('Archiver ce document ?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="table-btn btn-archive" title="Archiver">📦</button>
                            </form>
                            
                            <form action="{{ route('documents.destroy', $doc) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce document ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="table-btn btn-delete" title="Supprimer">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
              
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Section des boutons d'action - Placée après la liste -->
    <div class="action-buttons">
        <a href="{{ route('documents.create') }}" class="action-btn">
            ➕ Ajouter Document
        </a>
        <button class="action-btn" onclick="shareDocument()">
            📤 Partager Document
        </button>
        
        <!-- Nouveau bouton d'archivage pour la sélection -->
        <button class="action-btn btn-archive-selected" onclick="archiveSelected()">
            📦 Archiver Sélection
        </button>
        
        <button class="action-btn" onclick="deleteSelected()">
            🗑️ Supprimer Sélection
        </button>
        <button class="action-btn" onclick="downloadSelected()">
            📥 Télécharger Sélection
        </button>
        <button class="action-btn" onclick="showDetails()">
            📋 Détails
        </button>
        
        <!-- Bouton Dashboard en bas -->
        <a href="{{ route('dashboard') }}" class="dashboard-btn">
            🏠 Retour au Dashboard
        </a>
    </div>
</div>

<script>
    function shareDocument() {
        // Créer un dialogue pour partager un document
        const selected = getSelectedDocuments();
        if (selected.length === 0) {
            alert('Veuillez sélectionner au moins un document à partager.');
            return;
        }
        
        const email = prompt('Entrez l\'adresse email du destinataire:');
        if (email) {
            alert(`Document(s) partagé(s) avec ${email}`);
            // Ici vous pouvez ajouter la logique de partage
        }
    }

    function toggleAllCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.doc-checkbox');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });
    }

    function getSelectedDocuments() {
        const checkboxes = document.querySelectorAll('.doc-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    // Nouvelle fonction pour archiver la sélection
    function archiveSelected() {
        const selected = getSelectedDocuments();
        if (selected.length === 0) {
            alert('Veuillez sélectionner au moins un document à archiver.');
            return;
        }
        
        if (confirm(`Êtes-vous sûr de vouloir archiver ${selected.length} document(s) ?`)) {
            // Créer un formulaire dynamique pour envoyer les IDs des documents à archiver
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/documents/archive-multiple';
            
            // Ajouter le token CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            form.appendChild(csrfToken);
            
            // Ajouter la méthode PATCH
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);
            
            // Ajouter les IDs des documents sélectionnés
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
            alert('Veuillez sélectionner au moins un document à supprimer.');
            return;
        }
        
        if (confirm(`Êtes-vous sûr de vouloir supprimer ${selected.length} document(s) ?`)) {
            // Ici vous pouvez ajouter la logique de suppression multiple
            alert(`${selected.length} document(s) supprimé(s)`);
        }
    }

    function downloadSelected() {
        const selected = getSelectedDocuments();
        if (selected.length === 0) {
            alert('Veuillez sélectionner au moins un document à télécharger.');
            return;
        }
        
        // Ici vous pouvez ajouter la logique de téléchargement multiple
        alert(`Téléchargement de ${selected.length} document(s) en cours...`);
    }

    function showDetails() {
        const selected = getSelectedDocuments();
        if (selected.length === 0) {
            // Afficher les détails généraux de tous les documents
            alert('Affichage des détails de tous les documents');
        } else {
            // Afficher les détails des documents sélectionnés
            alert(`Affichage des détails de ${selected.length} document(s) sélectionné(s)`);
        }
        // Ici vous pouvez rediriger vers une page de détails ou ouvrir un modal
    }
</script>

<!-- Ajout du meta tag pour le token CSRF si pas déjà présent -->
<meta name="csrf-token" content="{{ csrf_token() }}">

</body>
</html>