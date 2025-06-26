<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
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
            margin-top: 20px;
            width: 100%;
            font-size: 1em;
        }

        button:hover {
            background-color: #4a6c6a;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #5a7c7a;
            text-decoration: none;
        }

        a:hover {
            color: #4a6c6a;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Ajouter un Utilisateur</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label for="name">Nom</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Ajouter</button>
    </form>

    <a href="{{ route('profil') }}">Annuler</a>
</div>
</body>
</html>
