<?php
session_start();
// Vérifie si l'utilisateur a déjà confirmé son âge
if (!isset($_SESSION['age_confirmed']) || $_SESSION['age_confirmed'] !== true) {
  header('Location: pages/verification_age/verification_age.php'); // Redirige vers la page de vérification d'âge
  exit;
}

$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
  $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
  die('Connection not possible, please check data!: ' . $e->getMessage());
}


require "_header.php";
if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION['user_id'];
}
$requete = $dbh->prepare("SELECT * FROM espace_membre WHERE id = ?");
$requete->bindParam(1, $user_id, PDO::PARAM_INT);
$requete->execute();

$user = $requete->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>page d'accueil</title>
  <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
  <link rel="shortcut icon" href="http://127.0.0.1/eliquide-menu/favicon.ico" type="image/x-icon">
</head>

<body>
  <header>
    <div class="logo">
      <a href="http://127.0.0.1/eliquide-menu/"><img src="http://127.0.0.1/eliquide-menu/logo.png" alt="" /></a>
    </div>



    <div class="menu-toggle">
      <span style="background-color: #d3ecff"></span>
      <span style="background-color: #d3ecff"></span>
      <span style="background-color: #d3ecff"></span>
    </div>

    <!-- bar des menu -->
    <nav class="menu">
      <ul>
        <li>
          <input class="searchbar" type="search" placeholder="rerchercher" required id="search" value=""
            onchange="ouvrirpages()" />
        </li>

        <li><a href="http://127.0.0.1/eliquide-menu/">accueil</a></li>

        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/menu-e-liquide.php">menu e-liquide</a>
        </li>
        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/eliquide.php">e-liquide</a>
        </li>
        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/CE.php">cigarette éléctronique</a>
        </li>
        <li>
          <a href="pages/panier.php">panier</a>
        </li>
        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/nous-contacter.php">contact</a>
        </li>
      </ul>
    </nav>


    <h1 style="color: #d3ecff; background-color: #2a2424">
      Bienvenue sur<span> e-liquide menu</span>
    </h1>
  </header>


  <div class="banniere">
    <h3 class="titre-main">Les produits de la semaine</h3>
    <div class="gradient-overlay"></div>
    <img src="http://127.0.0.1/eliquide-menu/img-main/banniere2-main.jpg" alt="montagne" class="img-main" />

  </div>
  <?php
  // Vérifier si l'utilisateur est connecté
  if (isset($_SESSION['user_id'])) {
    // Afficher le logo du profil
  
    echo '<div class="profile-logo" >
    <a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/favoris.php" class="image-space">
    <img  src="http://127.0.0.1/eliquide-menu/pages/img_aceuille/étoile.png" alt="Panier" /></a>
    
    <a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/profil.php" class="image-space">
    <img  src="http://127.0.0.1/eliquide-menu/img-main/boutonutilisateur.png" alt="Profil" />    <p style="text-align:center">';
    echo $user["pseudo"];
    echo '</p>';
    echo ' </a>

    <a href="http://127.0.0.1/eliquide-menu/pages/panier.php" class="image-space">
    <img  src="http://127.0.0.1/eliquide-menu/pages/img_aceuille/panier.png" alt="Panier" /> </a>

    </div>';


  } else {
    // Afficher les boutons d'inscription et de connexion
    echo '<div style="margin-top: 20px;text-align: center;">
            <a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/inscription.php" style="color: #fff; text-decoration: none; font-weight: bold; font-size: 16px; background-color: #2a2424; padding: 10px 20px; border-radius: 20px;">Inscription</a>
            <a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/conexion.php" style="color: #fff; text-decoration: none; font-weight: bold; font-size: 16px; background-color: #2a2424; padding: 10px 20px; border-radius: 20px;">Connexion</a>
          </div>';
  }
  ?>

  <?php $products = $DB->query('SELECT * FROM products WHERE id IN (9,11,12)'); ?>

  <div class="img-ce">
    <?php foreach ($products as $product): ?>
      <div class="overlay">

        <h3>
          <?= $product->name; ?>
        </h3>

        <p>
          <?= $product->description ?>
        </p>
        <a href="http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=<?= $product->id ?>"><img
            src=<?= $product->url_photo ?> alt="Image" class="img" /></a>

      </div>

    <?php endforeach ?>

  </div>
  <?php include 'footer.php'; ?>

  <script>
    // Fonction pour gérer le défilement
    window.addEventListener("scroll", () => {
      let scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

      // Ajustez cette valeur en fonction de la sensibilité de scrolling sur mobile
      let scrollTrigger = window.innerHeight * 0.3; // Ajusté à 30% de la hauteur de la fenêtre visible

      if (scrollTop > scrollTrigger) {
        // Changements de style lors du défilement vers le bas
        document.querySelector("h1").style.backgroundColor = "#d3ecff";
        document.querySelector("h1").style.color = "#2a2424";
        document.querySelector("h1").style.height = "50px";
        document.querySelector("h1").style.fontSize = "2vw";

        // Mise à jour des styles des spans du menu-toggle
        document.querySelectorAll(".menu-toggle span").forEach((span) => {
          span.style.backgroundColor = "#2a2424";
        });

        // Mise à jour du style de l'image du logo
        document.querySelector(".logo img").style.width = "30px";
      } else {
        // Changements de style lors du défilement vers le haut
        document.querySelector("h1").style.backgroundColor = "#2a2424";
        document.querySelector("h1").style.color = "#d3ecff";
        document.querySelector("h1").style.height = "95px";
        document.querySelector("h1").style.fontSize = "3vw";

        // Mise à jour des styles des spans du menu-toggle
        document.querySelectorAll(".menu-toggle span").forEach((span) => {
          span.style.backgroundColor = "#d3ecff";
        });

        // Mise à jour du style de l'image du logo
        document.querySelector(".logo img").style.width = "75px";
      }
    });
  </script>
  <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>