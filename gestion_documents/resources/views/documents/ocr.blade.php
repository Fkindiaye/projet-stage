<!DOCTYPE html>
@extends('layouts.app')

@section('styles')
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

        /* Éléments décoratifs en arrière-plan */
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
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(90, 124, 122, 0.05), transparent);
            animation: slide 3s infinite;
        }

        @keyframes slide {
            0% { left: -100%; }
            50% { left: 100%; }
            100% { left: 100%; }
        }

        .login-box h2 {
            text-align: center;
            color: #2c3e3c;
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 35px;
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

        .error-message {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
            position: relative;
            z-index: 1;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
            z-index: 1;
        }

        .form-group input {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid rgba(90, 124, 122, 0.2);
            border-radius: 15px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            position: relative;
        }

        .form-group input:focus {
            border-color: #5a7c7a;
            background: rgba(255, 255, 255, 0.98);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(90, 124, 122, 0.2);
        }

        .form-group input::placeholder {
            color: #6b7f7d;
            font-weight: 400;
            transition: all 0.3s ease;
        }

        .form-group input:focus::placeholder {
            color: transparent;
        }

        /* Labels flottants */
        .form-group label {
            position: absolute;
            left: 25px;
            top: 18px;
            color: #6b7f7d;
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.9);
            padding: 0 8px;
            border-radius: 4px;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -8px;
            left: 20px;
            font-size: 12px;
            color: #5a7c7a;
            font-weight: 500;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #5a7c7a 0%, #4a6c6a 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
            letter-spacing: 1px;
            text-transform: uppercase;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(90, 124, 122, 0.4);
            background: linear-gradient(135deg, #4a6c6a 0%, #3a5c5a 100%);
        }

        .submit-btn:active {
            transform: translateY(-2px);
        }

        .register-link {
            margin-top: 30px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .register-link {
            color: #6b7f7d;
            font-size: 15px;
            line-height: 1.6;
        }

        .register-link a {
            color: #5a7c7a;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 8px 15px;
            border-radius: 10px;
            display: inline-block;
            margin-left: 5px;
        }

        .register-link a:hover {
            background: rgba(90, 124, 122, 0.1);
            color: #4a6c6a;
            transform: translateY(-2px);
        }

        /* Animation d'entrée */
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

        .login-box {
            animation: fadeInScale 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-group {
            animation: fadeInScale 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .submit-btn { 
            animation: fadeInScale 0.6s ease forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }
        .register-link { 
            animation: fadeInScale 0.6s ease forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-box {
                padding: 35px 25px;
                width: 100%;
                margin: 0 10px;
                border-radius: 20px;
            }
            
            .login-box h2 {
                font-size: 28px;
                margin-bottom: 30px;
            }
            
            .form-group input {
                padding: 15px 20px;
                font-size: 15px;
            }
            
            .submit-btn {
                padding: 16px;
                font-size: 16px;
            }
        }

        /* Effet de focus sur le formulaire */
        .login-box:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        }
</style>
@endsection

@section('content')
<div class="container">
    <h1>OCR sur document</h1>
    
    <input type="file" id="ocr-file" accept="image/*" />
    <br><br>
    <button onclick="runOCR()">Lancer OCR</button>
    
    <h3>Texte reconnu :</h3>
    <pre id="ocr-result"></pre>
    <form id="ocr-save-form" style="display:none;" method="POST" action="{{ route('ocr.save') }}">
        @csrf
        <input type="hidden" name="document_id" value="{{ $document->id }}">
        <input type="hidden" name="recognized_text" id="recognized_text_input">
        <button type="submit">Enregistrer dans la base</button>
    </form>
</div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.5/dist/tesseract.min.js"></script>
<script>
function runOCR() {
    const file = document.getElementById('ocr-file').files[0];
    if (!file) return alert("Veuillez sélectionner une image.");
    const reader = new FileReader();
    reader.onload = function () {
        Tesseract.recognize(reader.result, 'fra', {
            logger: m => console.log(m)
        }).then(({ data: { text } }) => {
            document.getElementById('ocr-result').textContent = text;
            document.getElementById('recognized_text_input').value = text;
            document.getElementById('ocr-save-form').style.display = 'block';
        });
    };
    reader.readAsDataURL(file);
}
</script>
@endsection