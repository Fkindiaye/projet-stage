<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques de documents</title>
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
            max-width: 600px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid #aaa;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        .btn-retour {
            display: inline-block;
            padding: 10px 18px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1em;
            transition: background 0.3s ease;
        }

        .btn-retour:hover {
            background: linear-gradient(135deg, #4a6c6a 0%, #5a7c7a 100%);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Statistiques</h1>

        <table>
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre total de documents</td>
                    <td><strong>{{ $totalDocuments }}</strong></td>
                </tr>
                <tr>
                    <td>Nombre de documents partagés</td>
                    <td><strong>{{ $sharedDocuments }}</strong></td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('dashboard') }}" class="btn-retour">Retour</a>
    </div>

</body>
</html>
