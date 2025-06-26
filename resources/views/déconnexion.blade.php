<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
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
            margin-right: 10px;
        }

        button:hover {
            background-color: #4a6c6a;
        }

        .btn-secondary {
            background-color: #5a7c7a;
        }

        .btn-secondary:hover {
            background-color: #4a6c6a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Déconnexion</h1>
        <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
            <a href="{{ route('dashboard') }}" class="btn-secondary" style="text-decoration: none; padding: 10px 18px; border-radius: 4px; color: white;">Annuler</a>
        </form>
    </div>
</body>
</html>