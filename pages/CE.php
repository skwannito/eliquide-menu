<?php
session_start();
require "../_header.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>cigarette électronique</title>
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

    <h1>CE</h1>
  </header>

  <?php $products = $DB->query('SELECT * FROM products WHERE categorie = "ce"'); ?>
  <div class="img-ce">
    <?php foreach ($products as $product): ?>
      <div class="overlay">
        <h3>
          <?= $product->name ?>
        </h3>
        <p>
          <?= $product->description ?>
        </p>
        <a href="http://127.0.0.1/em/pages/CE/CE-pages.php?id=<?= $product->id ?>"><img
            src="<?= $product->url_photo ?>" alt="Image" class="img" /></a>
      </div>
    <?php endforeach; ?>
  </div>


  </div>
  <?php include '../footer.php'; ?>

  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>