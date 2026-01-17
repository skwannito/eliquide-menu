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
  $commandesn = $_POST["n_commande"];
  $message = $_POST["message"];


  $mail = new PHPMailer(true);

  try {

    $mail->isSMTP();
    $mail->Host = 'smtp.strato.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'service-apres-vente@eliquide-menu.fr';
    $mail->Password = 'Baptwann!27190405';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Paramètres du message
    $mail->setFrom('service-apres-vente@eliquide-menu.fr', $nom);
    $mail->addAddress('service-apres-vente@eliquide-menu.fr', 'Sav');
    $mail->Subject = 'service apres vente';
    $mail->Body = "Nom: $nom\nE-mail: $email\nnumero de commande: $commandesn\nMessage: $message";
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
  <title>Service Après-Vente</title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />

  <style>
    section {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input,
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }
  </style>
</head>

<body>
  <header>
    <h1>Service Après-Vente</h1>
    <div class="logo">
      <a href="http://127.0.0.1/em/"><img src="http://127.0.0.1/em/logo.png" alt="" /></a>
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

        <li><a href="http://127.0.0.1/em/">accueil</a></li>

        <li>
          <a href="http://127.0.0.1/em/pages/menu-e-liquide.php">menu e-liquide</a>
        </li>
        <li>
          <a href="http://127.0.0.1/em/pages/eliquide.php">e-liquide</a>
        </li>
        <li>
          <a href="http://127.0.0.1/em/pages/CE.php">cigarette électronique</a>
        </li>
        <li>
          <a href="http://127.0.0.1/em/pages/panier.php">panier</a>
        </li>
        <li>
          <a href="http://127.0.0.1/em/pages/nous-contacter.php">contact</a>
        </li>
      </ul>
    </nav>
  </header>

  <section>
    <h2>Service Après-vente</h2>
    <p>
      Si vous avez des problèmes avec votre commande, veuillez remplir le
      formulaire ci-dessous.
    </p>

    <form action="#" method="post">
      <label for="nom">Nom :</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required />

      <label for="n_commande">N° de commande :</label>
      <input type="n_commande" id="n_commande" name="n_commande" required />

      <label for="message">Message :</label>
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

  <?php include '../footer.php'; ?>

  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>