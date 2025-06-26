<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerController extends Controller
{
    public function send()
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = '8fa660001@smtp-brevo.com';
            $mail->Password = 'YnOSrECBjyPdR57p';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('tonemail@domaine.com', 'Ma Plateforme');
            $mail->addAddress('destinataire@exemple.com');

            $mail->isHTML(true);
            $mail->Subject = 'Test PHPMailer depuis Laravel';
            $mail->Body = 'Ceci est un test avec PHPMailer dans Laravel.';

            $mail->send();
            return 'Email envoyé avec succès !';
        } catch (Exception $e) {
            return "Erreur : {$mail->ErrorInfo}";
        }
    }
}
