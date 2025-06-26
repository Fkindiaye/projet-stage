<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gestion_documents");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // 'user' ou 'admin'

    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $mot_de_passe, $role);

    if ($stmt->execute()) {
        // Connexion automatique après inscription
        $_SESSION['utilisateur_id'] = $conn->insert_id;
        $_SESSION['nom'] = $nom;
        $_SESSION['role'] = $role;

        if ($role === 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit;
    } else {
        $erreur = "Erreur lors de l'inscription : " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        /* Ton style reste inchangé */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1eb 0%, #ede5db 50%, #e8ddd0 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 400px;
            max-width: 90vw;
            border: 1px solid rgba(90, 124, 122, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent, rgba(90, 124, 122, 0.03), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .login-box h2 {
            text-align: center;
            color: #2c3e3c;
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 1px;
            z-index: 1;
        }

        .error-message {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            z-index: 1;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
            z-index: 1;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        .form-group:nth-child(5) { animation-delay: 0.4s; }
        .form-group:nth-child(6) { animation-delay: 0.5s; }

        input, select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(90, 124, 122, 0.2);
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus, select:focus {
            border-color: #5a7c7a;
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(90, 124, 122, 0.15);
        }

        input::placeholder {
            color: #6b7f7d;
            font-weight: 400;
        }

        select { color: #6b7f7d; cursor: pointer; }
        select option { color: #333; background: white; padding: 10px; }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            letter-spacing: 0.5px;
            animation-delay: 0.6s;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .register-link {
            margin-top: 25px;
            text-align: center;
            color: #6b7f7d;
            font-size: 14px;
            z-index: 1;
        }

        .register-link a {
            color: #5a7c7a;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .register-link a:hover {
            background: rgba(90, 124, 122, 0.1);
            color: #4a6c6a;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 30px 25px;
                width: 100%;
                margin: 0 10px;
            }

            .login-box h2 {
                font-size: 24px;
                margin-bottom: 25px;
            }

            input, select {
                padding: 12px 15px;
                font-size: 15px;
            }

            .submit-btn {
                padding: 14px;
                font-size: 15px;
            }
        }

        .login-box:hover {
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="login-box">
<h2>Inscription</h2>

{{-- Affichage des erreurs --}}
@if ($errors->any())
    <div class="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <input type="password" name="password" placeholder="Mot de passe" required>
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
    </div>

    <div class="form-group">
        <select name="role" required>
            <option value="">Sélectionner un rôle</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur simple</option>
        </select>
    </div>

    <button type="submit" class="submit-btn">Créer un compte</button>
</form>

  <div class="register-link">
    Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
  </div>
</div>
</body>
</html>
