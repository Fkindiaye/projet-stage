<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Documents Archivés</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            margin: 0;
            padding: 40px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin: 20px 0 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #5a7c7a;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            background-color: #5a7c7a;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #4a6c6a;
        }

        .no-results {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            color: #777;
        }

        .dashboard-link {
            display: inline-block;
            font-size: 1.6em;
            text-decoration: none;
            color: white;
            background-color: #5a7c7a;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 30px;
            font-weight: bold;
        }

        .dashboard-link:hover {
            background-color: #4a6c6a;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1>📦 Documents Archivés</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if($documents->count())
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->titre }}</td>
                            <td>{{ $document->user->name ?? 'N/A' }}</td>
                            <td>{{ $document->created_at->format('d/m/Y') }}</td>
                            <td>{{ $document->description }}</td>
                            <td>
                                <form action="{{ route('documents.restore', $document->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn">Désarchiver</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-results">Aucun document archivé trouvé.</div>
        @endif

        <!-- Bouton de retour au tableau de bord EN BAS -->
        <div style="text-align: center;">
            <a href="{{ route('dashboard') }}" class="dashboard-link">Retour</a>
        </div>
        
    </div>
</body>
</html>