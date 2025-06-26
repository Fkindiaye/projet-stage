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

        /* Champs de formulaire */
        form label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
        }

        form input[type="text"],
        form select,
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        /* Conteneur boutons pour aligner horizontalement */
        .form-buttons {
            margin-top: 15px;
            display: flex;
            justify-content: flex-start;
            gap: 15px; /* espace entre les boutons */
        }

        button, .btn-cancel {
            background-color: #5a7c7a;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            line-height: normal;
        }

        button:hover, .btn-cancel:hover {
            background-color: #4a6c6a;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Téléverser un Document</h1>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="3"></textarea>

        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
            <option value="">-- Sélectionner --</option>
            <option value="rapport">Rapport</option>
            <option value="guide">Guide</option>
            <option value="règlement">Règlement</option>
            <option value="autre">Autre</option>
        </select>

        <label for="categorie_autre" style="display:none;" id="label_categorie_autre">Précisez la catégorie :</label>
        <input type="text" id="categorie_autre" name="categorie_autre" style="display:none;" placeholder="Autre catégorie">

        <label for="fichier">Fichier :</label>
        <input type="file" id="fichier" name="fichier" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png" required>


        <div class="form-buttons">
            <button type="submit">Téléverser</button>
            <a href="{{ route('dashboard') }}" class="btn-cancel">Annuler</a>
        </div>
    </form>
</div>

<script>
    // Affiche le champ texte "Autre catégorie" si "Autre" est sélectionné dans la liste
    const selectCategorie = document.getElementById('categorie');
    const inputCategorieAutre = document.getElementById('categorie_autre');
    const labelCategorieAutre = document.getElementById('label_categorie_autre');

    selectCategorie.addEventListener('change', function() {
        if (this.value === 'autre') {
            inputCategorieAutre.style.display = 'block';
            labelCategorieAutre.style.display = 'block';
            inputCategorieAutre.required = true;
        } else {
            inputCategorieAutre.style.display = 'none';
            labelCategorieAutre.style.display = 'none';
            inputCategorieAutre.required = false;
            inputCategorieAutre.value = '';
        }
    });
</script>
</body>
</html>
