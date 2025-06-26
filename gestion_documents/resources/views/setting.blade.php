<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramètres du compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: auto;
            padding-top: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Paramètres du Compte</h1>

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}">

        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="Laisser vide si inchangé">

        <label for="language">Langue :</label>
        <select name="language" id="language">
            <option value="fr" {{ auth()->user()->language == 'fr' ? 'selected' : '' }}>Français</option>
            <option value="en" {{ auth()->user()->language == 'en' ? 'selected' : '' }}>Anglais</option>
        </select>

        <button type="submit">Enregistrer</button>
    </form>
</div>
</body>
</html>