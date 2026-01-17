<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
  <title>Frais de Livraison</title>
  <style>
    section {
      margin: 20px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    h3 {
      color: #555;
    }

    p {
      line-height: 1.6;
    }
  </style>
</head>

<body>
  <header>
    <h1>Frais de Livraison</h1>
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
  <div class="paddi"></div>
  <div class="sections">
    <section id="chronopost">
      <img src="http://127.0.0.1/em/pages/img-livraison/Chronopost_logo_2015.png" alt="Chronopost Logo"
        style="width: 15%" />
      <h2>Chronopost</h2>

      <article>
        <h3>Tarifs</h3>
        <p>
          Les frais de livraison via Chronopost sont calculés en fonction du
          poids et de la destination de votre colis. Vous pouvez consulter les
          tarifs au moment de finaliser votre commande.
        </p>
      </article>

      <article>
        <h3>Délais de Livraison</h3>
        <p>
          Chronopost offre des services de livraison rapides et fiables. Les
          délais varient en fonction du service que vous choisissez lors de
          votre commande.
        </p>
      </article>
    </section>

    <section id="mondial-relay">
      <img src="http://127.0.0.1/em/pages/img-livraison/mrlogoprincipal.png" alt="Chronopost Logo"
        style="width: 15%" />
      <h2>Mondial Relay</h2>

      <article>
        <h3>Tarifs</h3>
        <p>
          Les frais de livraison avec Mondial Relay sont également calculés en
          fonction du poids et de la destination de votre colis. Vous pouvez
          consulter les tarifs au moment de finaliser votre commande.
        </p>
      </article>

      <article>
        <h3>Délais de Livraison</h3>
        <p>
          Mondial Relay propose des délais de livraison compétitifs. La
          rapidité dépend du service que vous choisissez lors de la commande.
        </p>
      </article>
    </section>
  </div>
  <?php include '../footer.php'; ?>

  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>