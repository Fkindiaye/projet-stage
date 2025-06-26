<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Partager un Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
            display: block;
            margin-bottom: 6px;
        }

        form input[type="email"],
        form select,
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        /* Conteneur des boutons */
        .form-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            margin-top: 10px;
        }

        button, 
        .btn-cancel {
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        button:hover,
        .btn-cancel:hover {
            background: linear-gradient(135deg, #4a6c6a 0%, #5a7c7a 100%);
        }

        /* Affichage des erreurs */
        .errors {
            color: red;
            margin-bottom: 15px;
        }
        .errors ul {
            padding-left: 20px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Partager le document</h1>
        <p><strong>Titre :</strong> {{ $document->titre }}</p>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('documents.share', $document) }}" method="POST">
            @csrf
            <label for="email">Adresse e-mail du destinataire :</label>
            <input type="email" name="email" id="email" required placeholder="ex: exemple@email.com">
            <div class="form-buttons">
                <button type="submit">Partager</button>
                <a href="{{ route('documents.details', $document) }}" class="btn-cancel">Retour</a>
            </div>
        </form>
    </div>
</body>
</html>
