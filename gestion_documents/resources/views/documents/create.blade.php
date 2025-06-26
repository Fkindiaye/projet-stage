<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Téléverser un Document</title>
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            margin: 0;
            padding: 0;
        }

        /* Conteneur principal */
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        /* Titre principal */
        h1 {
            text-align: center;
            margin: 20px 0;
        }

        /* Liens du tableau de bord */
        .dashboard-link {
            display: block;
            font-size: 2.4em;
            text-decoration: none;
            color: #333;
            margin-bottom: 15px;
        }

        /* Texte en gras dans les liens */
        .dashboard-link span {
            font-weight: bold;
        }

        /* Champs de formulaire */
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
            background-color: #5a7c7a;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
        }

        button:hover {
            background-color: #4a6c6a;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Téléverser un Document</h1>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Titre :</label>
    <input type="text" name="titre" required>

    <label>Description :</label>
    <textarea name="description" rows="3"></textarea>

    <label>Catégorie :</label>
    <select name="categorie" required>
        <option value="">-- Sélectionner --</option>
        <option value="rapport">Rapport</option>
        <option value="guide">Guide</option>
        <option value="règlement">Règlement</option>
    </select>

    <label>Fichier :</label>
    <input type="file" name="file" required>

    <button type="submit">Téléverser</button>
</form>
</div>
</body>
</html>