<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Utilisateur - Archivage</title>
    <style>
        /* Reset global */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 100%);
            display: flex;
            height: 100vh;
            overflow-y: auto;
            position: relative;
        }

        /* Éléments décoratifs animés */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 30% 20%, rgba(90, 124, 122, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(90, 124, 122, 0.03) 0%, transparent 50%);
            animation: floating 20s ease-in-out infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes floating {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(1deg); }
            66% { transform: translate(-20px, 20px) rotate(-0.5deg); }
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: linear-gradient(180deg, #5a7c7a 0%, #4a6c6a 100%);
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            color: white;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            z-index: 10;
            position: relative;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.6em;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .sidebar a, .sidebar span.nav-item {
            display: flex;
            align-items: center;
            padding: 18px 25px;
            color: white;
            text-decoration: none;
            font-size: 1.05em;
            font-weight: 400;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            cursor: pointer;
        }

        .sidebar span.nav-item.active {
            border-left: 3px solid #f5f1eb;
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .sidebar a:hover, .sidebar span.nav-item:hover {
            background-color: rgba(255,255,255,0.1);
            border-left: 3px solid #f5f1eb;
            transform: translateX(5px);
        }

        .sidebar a span.emoji, .sidebar span.nav-item span.emoji {
            margin-right: 12px;
            font-size: 1.4em;
            width: 24px;
            text-align: center;
        }

        /* Main content */
        .welcome-content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
            position: relative;
            z-index: 10;
            max-width: 100%;
        }

        /* Titres principaux */
        .main-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
            color: #2c3e3c;
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: -0.5px;
            line-height: 1.2;
            animation: fadeInUp 1s ease-out;
        }

        .main-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #5a7c7a, #7a9c9a);
            margin: 25px auto;
            border-radius: 2px;
            animation: expandWidth 1.5s ease 0.5s both;
        }

        @keyframes expandWidth {
            from { width: 0; }
            to { width: 100px; }
        }

        .subtitle {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: #4a6c6a;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 400;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        /* Sections générales */
        .content-section {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(90, 124, 122, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out both;
        }

        .content-section h2 {
            font-size: clamp(1.3rem, 2.5vw, 1.6rem);
            font-weight: 400;
            color: #2c3e3c;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        /* Nombre total documents */
        .stats-total-documents {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e3c;
            text-align: center;
            padding: 25px 15px;
            background: rgba(90, 124, 122, 0.1);
            border-radius: 12px;
            margin-bottom: 40px;
            box-shadow: inset 0 0 10px rgba(90,124,122,0.15);
            user-select: none;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }

            .welcome-content {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .main-title::after {
                width: 60px;
                height: 3px;
                margin: 15px auto;
            }

            .content-section {
                padding: 20px 15px;
                border-radius: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar allégée -->
    <div class="sidebar">
        <h2>Tableau de bord Utilisateur</h2>
        <span class="nav-item active"><span class="emoji">🏠</span> Accueil</span>
        <a href="{{ route('documents.index') }}"><span class="emoji">📄</span> Documents</a>
        <a href="{{ route('documents.stats') }}" class="nav-item">
        <a href="{{ route('documents.stats') }}" class="nav-item"><span class="emoji">📊</span>Statistiques</a>
        <a href="{{ route('déconnexion') }}"><span class="emoji">🚪</span> Déconnexion</a>
    </div>

    <!-- Contenu principal -->
    <div class="welcome-content">
        <h1 class="main-title">Bienvenue sur votre espace personnel d'archivage numérique</h1>
        <p class="subtitle">Retrouvez, archiver et sécurisez tous vos documents en quelques clics.</p>

        <div style="text-align: center; margin-top: 20px;">
            <img src="{{ asset('images/archivage.jpeg') }}" alt="Image archivage" style="width: 400px; max-width: 90%; height: auto;">
        </div>

        <!-- Statistiques documents -->
      

        <section class="content-section presentation">
            <h2>À quoi sert cette plateforme ?</h2>
            <p>Notre solution d'archivage électronique permet une gestion sécurisée et intuitive de vos documents. Elle facilite le classement, la recherche, l'accès et la sauvegarde de toutes vos archives numériques avec une interface moderne et des fonctionnalités avancées.</p>
        </section>
        
        <section class="content-section objectives">
            <h2>Notre objectif :</h2>
            <ul>
                <li>🗃️ Faciliter l’accès rapide aux documents archivés</li>
                <li>📁 Optimiser la gestion du cycle de vie des documents</li>
                <li>📈 Améliorer la productivité administrative</li>       
            </ul>
        </section>
    </div>

</body>
</html>
