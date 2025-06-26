<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document Partagé</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 50%, #e8ddd0 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(90, 124, 122, 0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 45px;
            border-radius: 25px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.15);
            width: 420px;
            max-width: 90vw;
            border: 1px solid rgba(90, 124, 122, 0.1);
            position: relative;
            z-index: 10;
            overflow: hidden;
            animation: fadeInScale 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-box h2 {
            text-align: center;
            color: #2c3e3c;
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 25px;
            letter-spacing: 1.5px;
            position: relative;
            z-index: 1;
        }

        .login-box h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #5a7c7a, #7a9c9a);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        .login-box p {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .login-box a {
            display: inline-block;
            background: #5a7c7a;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .login-box a:hover {
            background: #4a6c6a;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Un document vous a été partagé !</h2>
        <p><strong>Titre :</strong> {{ $document->titre }}</p>
        <p><strong>Catégorie :</strong> {{ $document->categorie }}</p>
        <p><strong>Date d'ajout :</strong> {{ $document->created_at->format('d/m/Y') }}</p>
        <p>
            <a href="{{ asset('storage/' . $document->fichier) }}">📥 Télécharger le document</a>
        </p>
    </div>
</body>
</html>
