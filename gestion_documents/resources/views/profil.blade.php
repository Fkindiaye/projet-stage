<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Profil Utilisateur</title>
    <style>
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
        padding: 20px 0;
    }

    h1 {
        text-align: center;
        margin: 20px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }

    /* ✅ Boutons avec ta couleur personnalisée */
    button, .btn, .btn-danger {
        background-color: #5a7c7a;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
        margin-right: 5px;
        text-decoration: none;
        display: inline-block;
    }

    /* ✅ Effet de survol pour tous les boutons */
    button:hover, .btn:hover, .btn-danger:hover {
        background-color: #4a6c6a;
    }

    .btn-add {
        margin-bottom: 15px;
        display: inline-block;
    }
</style>

</head>
<body>
    <div class="container">

        <h1>Liste des Utilisateurs</h1>

        <a href="{{ route('users.create') }}" class="btn btn-add">Ajouter un Utilisateur</a>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- Nouvelle colonne pour les boutons -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn">Modifier</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>
