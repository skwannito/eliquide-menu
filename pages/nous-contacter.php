<?php
session_start();
$error_message = "";
$success_message = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nom = $_POST["name"];
  $email = $_POST["email"];
  $telephone = $_POST["phone"];
  $message = $_POST["message"];


  $mail = new PHPMailer(true);

  try {

    $mail->isSMTP();
    $mail->Host = 'smtp.strato.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@eliquide-menu.fr';
    $mail->Password = 'Baptwann!27190405';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Paramètres du message
    $mail->setFrom('contact@eliquide-menu.fr', $nom);
    $mail->addAddress('contact@eliquide-menu.fr', 'contact');
    $mail->Subject = 'Formulaire de Contact';
    $mail->Body = "Nom: $nom\nE-mail: $email\nTelephone: $telephone\nMessage: $message";
    // Ajouter des pièces jointes
    if (!empty($_FILES['attachment']['name'])) {
      $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
    }

    // Envoyer le message
    $mail->send();

    // Message de succès
    $success_message = "Le message a été envoyé avec succès. Nous vous contacterons bientôt.";

  } catch (Exception $e) {
    // Message d'erreur en cas d'échec
    $error_message = "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>nous contacter</title>
  <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
  <title>Nous Contacter</title>
  <style>
    section {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(250, 246, 246, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }

    .call-us {
      text-align: center;
      margin-top: 20px;
    }

    .call-us p {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .phone-number {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    .text-explicatif {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>

<body>

  <header>
    <div class="logo">
      <a href="http://127.0.0.1/eliquide-menu/"><img src="http://127.0.0.1/eliquide-menu/logo.png" alt="" /></a>
    </div>

    <div class="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <!-- bar des menu -->
    <nav class="menu">
      <ul>
        <li>
          <input class="searchbar" type="search" placeholder="rerchercher" required id="search" value=""
            onchange="ouvrirpages()" />
        </li>

        <li><a href="http://127.0.0.1/eliquide-menu/">accueil</a></li>

        <li><a href="http://127.0.0.1/eliquide-menu/pages/menu-e-liquide.php">menu e-liquide</a></li>
        <li><a href="http://127.0.0.1/eliquide-menu/pages/eliquide.php">e-liquide</a></li>
        <li><a href="http://127.0.0.1/eliquide-menu/pages/CE.php">cigarette électronique</a></li>
        <li><a href="http://127.0.0.1/eliquide-menu/pages/panier.php">panier</a></li>
        <li><a href="http://127.0.0.1/eliquide-menu/pages/nous-contacter.php">contact</a></li>

      </ul>
    </nav>
    <h1>Nous Contacter</h1>

  </header>


  <section>

    <form method="POST" action="" enctype="multipart/form-data">
      <label for="name">Nom<span style="color: red;">*</span> :</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email<span style="color: red;">*</span> :</label>
      <input type="email" id="email" name="email" required />

      <label for="phone">Téléphone :</label>
      <input type="tel" id="phone" name="phone" />

      <label for="message">Message<span style="color: red;">*</span> :</label>
      <textarea id="message" name="message" rows="4" required></textarea>

      <label for="attachment">Pièce jointe :</label>
      <input type="file" name="attachment" id="attachment" />

      <button type="submit">Envoyer</button>
    </form>
    <?php if ($success_message): ?>
      <p style="color: green;">
        <?php echo $success_message; ?>
      </p>
    <?php endif; ?>

    <?php if ($error_message): ?>
      <p style="color: red;">
        <?php echo $error_message; ?>
      </p>
    <?php endif; ?>
  </section>

  <div class="call-us">
    <p>Pour plus d'assistance, n'hésitez pas à nous appeler :</p>
    <p class="phone-number">+33 7 69 37 46 41 (appel non surtaxé)</p>
  </div>

  <div class="text-explicatif">
    <p>
      Cette espace est dédiée à la communication directe avec notre équipe.
      <br>
      Remplissez le formulaire ci-dessus pour nous faire part de vos
      questions, préoccupations ou commentaires.
      <br>
      Nous sommes là pour vous
      aider!
    </p>
  </div>
  <?php include '../footer.php'; ?>


  <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>