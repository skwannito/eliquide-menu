<?php
// Démarrez la session
session_start();

// Fonction pour générer un code de confirmation à 6 chiffres
function generateConfirmationCode()
{
    return mt_rand(100000, 999999);
}

// Récupérer l'adresse e-mail saisie par l'utilisateur
$email = $_POST['email'];

// Générer un code de confirmation
$confirmationCode = generateConfirmationCode();

// Stockez le code de confirmation dans la session
$_SESSION['confirmation_code'] = $confirmationCode;

// Ici, vous pouvez ajouter du code pour envoyer l'e-mail avec le code de confirmation
// Par exemple, avec la fonction mail() de PHP ou une bibliothèque externe comme PHPMailer

// Simuler l'envoi de l'e-mail (remplacez cela par votre propre logique d'envoi d'e-mail)
$subject = 'Code de confirmation';
$message = "
<html>
<head>
    <title>Vous avez oublié votre mot de passe ?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px;
            height: auto;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .h2code {
        text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='logo'>
            <img src='http://127.0.0.1/eliquide-menu/logo.png' alt='Logo du site'>
        </div>
        <h2>Bonjour, $prenom $nom !</h2>
        <p>Vous avez demandé la réinitialisation de votre mot de passe pour votre compte <b>Eliquide Menu</b>.</p>
        <p>Voici votre code de vérification à usage unique : <br><br> <h2 class='h2code'>$confirmationCode</h2></p>
        <p>Ce code est valable pendant 15 minutes. Veuillez l'entrer sur la page de réinitialisation du mot de passe pour créer un nouveau mot de passe.
        Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet e-mail et votre mot de passe restera inchangé.</p>
        <p>Merci de votre confiance, <br> L'équipe Eliquide Menu</p>
        <div class='footer'>
            <p><a href='http://127.0.0.1/em'>Visitez notre site</a> | <a href='mailto:support@eliquide-menu.fr'>Contactez-nous</a></p>
        </div>
    </div>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: no-reply@eliquide-menu.fr' . "\r\n";

// Envoyer l'e-mail
$mailSent = mail($email, $subject, $message, $headers);

if (!$mailSent) {
    // Gestion de l'échec de l'envoi de l'e-mail
    echo "Une erreur s'est produite lors de l'envoi de l'e-mail. Veuillez réessayer.";
    exit;
}

// Rediriger l'utilisateur vers une page pour saisir le code de confirmation
header("Location: saisie_code.php?email=" . urlencode($email));
exit;
?>