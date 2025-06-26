<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .dashboard-link {
            display: block;
            font-size: 2.4em;
            text-decoration: none;
            color: #333;
            margin-bottom: 15px;
        }

        .dashboard-link span {
            font-weight: bold;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form select,
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Modifier le Document</h1>

    <form action="{{ route('documents.update', $document) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="{{ $document->titre }}" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="3">{{ $document->description }}</textarea>

        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" required>
            <option value="rapport" {{ $document->categorie == 'rapport' ? 'selected' : '' }}>Rapport</option>
            <option value="guide" {{ $document->categorie == 'guide' ? 'selected' : '' }}>Guide</option>
            <option value="règlement" {{ $document->categorie == 'règlement' ? 'selected' : '' }}>Règlement</option>
        </select>

        <label for="file_path">Changer le fichier (optionnel) :</label>
        <input type="file" name="file_path" id="file_path">

        <button type="submit">💾 Mettre à jour</button>
    </form>
</div>
</body>
</html>
