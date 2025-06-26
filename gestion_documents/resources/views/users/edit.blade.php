<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modifier l'utilisateur</title>
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
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Titre principal */
        h1 {
            text-align: center;
            margin: 20px 0;
        }

        /* Champs de formulaire */
        form label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form input[type="email"],
        form select,
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
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
            width: 100%;
        }

        button:hover {
            background-color: #4a6c6a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier l'utilisateur</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
