<?php
session_start();
require "../_header.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>menu e-liquide</title>
  <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
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
          <a href="http://127.0.0.1/eliquide-menu/pages/CE.php">cigarette électronique</a>
        </li>
        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/panier.php">panier</a>
        </li>
        <li>
          <a href="http://127.0.0.1/eliquide-menu/pages/nous-contacter.php">contact</a>
        </li>
      </ul>
    </nav>

    <h1>menu e-liquide</h1>
  </header>

  <!-- image e-liquide -->

  <?php $products = $DB->query('SELECT * FROM products WHERE categorie = "menu"'); ?>
  <div class="img-ce">
    <?php foreach ($products as $product): ?>
      <div class="overlay">
        <h3>
          <?= $product->name ?>
        </h3>
        <p>
          <?= $product->description ?>
        </p>
        <a href="http://127.0.0.1/eliquide-menu/pages/menu/menu-pages.php?id=<?= $product->id ?>"><img
            src="<?= $product->url_photo ?>" alt="Image" class="img" /></a>
      </div>
    <?php endforeach; ?>
  </div>
  <?php include '../footer.php'; ?>

  <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>