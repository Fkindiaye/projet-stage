<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Archivage</title>
    <style>
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
        }

        /* Éléments décoratifs animés */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 20%, rgba(90, 124, 122, 0.05) 0%, transparent 50%),
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

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 18px 25px;
            color: white;
            text-decoration: none;
            font-size: 1.05em;
            font-weight: 400;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar a span.emoji {
            margin-right: 12px;
            font-size: 1.4em;
            width: 24px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.1);
            border-left: 3px solid #f5f1eb;
            transform: translateX(5px);
        }

        .main {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
            position: relative;
            z-index: 10;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-bar {
            width: 350px;
            padding: 15px 20px;
            border-radius: 25px;
            border: none;
            background-color: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            outline: none;
            background-color: rgba(255,255,255,0.95);
            box-shadow: 0 6px 25px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .user-icon {
            background: linear-gradient(135deg, #5a7c7a 0%, #7a9c9a 100%);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .user-icon:hover {
            transform: scale(1.1);
        }

        /* Contenu de la page d'accueil intégré */
        .welcome-content {
            max-width: 100%;
            position: relative;
            z-index: 10;
        }

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

        /* Sections */
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

        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(90, 124, 122, 0.03), transparent);
            transition: left 0.8s ease;
        }

        .content-section:hover::before {
            left: 100%;
        }

        .content-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .presentation {
            animation-delay: 0.4s;
        }

        .objectives {
            animation-delay: 0.6s;
        }

        /* Titres de section */
        .content-section h2 {
            font-size: clamp(1.3rem, 2.5vw, 1.6rem);
            font-weight: 400;
            color: #2c3e3c;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .content-section h2::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 25px;
            background: linear-gradient(135deg, #5a7c7a, #7a9c9a);
            border-radius: 3px;
            opacity: 0;
            animation: slideInLeft 0.8s ease 1s both;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        /* Paragraphes */
        .content-section p {
            font-size: 1rem;
            line-height: 1.7;
            color: #4a6c6a;
            position: relative;
            z-index: 1;
        }

        /* Liste des objectifs */
        .objectives ul {
            list-style: none;
            padding: 0;
            position: relative;
            z-index: 1;
        }

        .objectives li {
            font-size: 1rem;
            line-height: 1.7;
            color: #4a6c6a;
            margin-bottom: 15px;
            padding: 15px 20px;
            background: rgba(90, 124, 122, 0.05);
            border-radius: 12px;
            border-left: 4px solid #5a7c7a;
            transition: all 0.3s ease;
            animation: fadeInRight 0.8s ease both;
        }

        .objectives li:nth-child(1) { animation-delay: 1.2s; }
        .objectives li:nth-child(2) { animation-delay: 1.4s; }
        .objectives li:nth-child(3) { animation-delay: 1.6s; }
        .objectives li:nth-child(4) { animation-delay: 1.8s; }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .objectives li:hover {
            background: rgba(90, 124, 122, 0.1);
            transform: translateX(8px);
            box-shadow: 0 6px 20px rgba(90, 124, 122, 0.15);
        }

        .objectives li strong {
            color: #2c3e3c;
            font-weight: 600;
        }

        /* Animations d'entrée */
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

        /* Section des documents récents */
        .recent-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 500;
            color: #2c3e3c;
            margin-bottom: 20px;
            padding-left: 5px;
        }

        .file-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .file-card {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(90,124,122,0.1);
        }

        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            background: rgba(255,255,255,0.95);
        }

        .file-card span.emoji {
            font-size: 28px;
            color: #5a7c7a;
            margin-bottom: 10px;
            display: block;
            transition: transform 0.3s ease;
        }

        .file-card:hover span.emoji {
            transform: scale(1.1);
        }

        .file-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: #2c3e3c;
            font-size: 12px;
        }

        .file-date {
            font-size: 10px;
            color: #6b7f7d;
            font-weight: 400;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }

            .main {
                padding: 20px;
            }

            .search-bar {
                width: 200px;
            }

            .content-section {
                padding: 25px 20px;
                margin-bottom: 20px;
            }

            .file-section {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 12px;
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

            .objectives li {
                font-size: 0.9rem;
                padding: 12px 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar inchangée -->
    <div class="sidebar">
        <h2>Tableau de bord</h2>
        <span class="nav-item active"><span class="emoji">🏠</span> Accueil</span>
        <a href="{{ route('documents.index') }}"><span class="emoji">📄</span> Documents</a>
        <a href="{{ route('archives') }}"><span class="emoji">🗄️</span> Archives</a>
        <a href="{{ route('profil') }}"><span class="emoji">👤</span> Profil</a>
        <a href="{{ route('admin.stats') }}" class="dashboard-link"><span>📊 Statistiques</span></a>
        <a href="{{ route('parametres') }}"><span class="emoji">⚙️</span> Paramètres</a>
        <a href="{{ route('déconnexion') }}"><span class="emoji">🚪</span> Déconnexion</a>
    </div>

    <!-- Contenu principal avec contenu d'accueil intégré -->

        <div class="welcome-content">
            <h1 class="main-title">Bienvenue sur votre espace personnel d'archivage numérique</h1>
            <p class="subtitle">Retrouvez, archiver et sécurisez tous vos documents en quelques clics.</p>
         <div style="text-align: center; margin-top: 20px;">
            <img src="{{ asset('images/archivage.jpeg') }}" alt="Image archivage" style="width: 400px; max-width: 90%; height: auto;">
         </div>
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

       
            </div>
        </div>
    </div>

</body>
</html>