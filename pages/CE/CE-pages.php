<?php
session_start();
require "../../_header.php";

// Vérifiez si le paramètre 'id' existe dans l'URL
if (isset($_GET['id'])) {
  // Récupérez la valeur de 'id'
  $product = $DB->query("SELECT * FROM products WHERE id=:id", [':id' => $_GET['id']]);
  $product = $product[0];
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
</head>

<body>
  <header>
    <div class="logo">
      <a href="http://127.0.0.1/em/"><img src="http://127.0.0.1/em/logo.png" alt="" /></a>
    </div>

    <div class="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>

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
    <h1></h1>
  </header>

  <div class="eliquide-container">
    <h3 class="titre-eliquide">
      <?= $product->name; ?>
    </h3>
    <img class="eliquide" src="<?= $product->url_photo ?>" alt="image" />
    <p class="p-eliquide">
      <?= $product->paragraphe ?>
    </p>
    <div class="btn-payer">
      <a href="../../addpanier.php?id=<?= $_GET["id"]; ?>" class="bouton-eliquide">Ajouter au panier</a>
      <a class="bouton-eliquide prix">
        <?= $product->price; ?>€
      </a>
    </div>
  </div>

  <?php include '../../footer.php'; ?>

  <script src="http://127.0.0.1/em/script.js"></script>

</body>

</html>