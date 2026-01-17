<?php if (!isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Conditions Générales de Vente</title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />

  <style>
    h1 {
      color: #333;
    }

    section {
      text-align: center;
      margin: 20px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      margin-top: 20px;
    }

    p {
      color: #555;
    }
  </style>
</head>

<body>
  <header>
    <h1>Conditions Générales de Vente</h1>
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
    <h2>1. Dispositions générales</h2>
    <p>
      1.1. Ces conditions générales de vente
      <a href="http://127.0.0.1/em/pages/condition-generales/pdf/CGV-eliquide-menu.pdf"><b
          style="text-decoration: underline">(CGV)</b></a>
      s'appliquent à toutes les ventes de produits effectuées par
      <b>eliquide-menu</b> sur son site internet <b>eliquid-menu.fr</b>
    </p>

    <h2>2. Commandes et paiements</h2>
    <p>
      2.1. Pour passer une commande, l'acheteur doit suivre le processus de
      commande en ligne et cliquer sur "Valider la commande".
    </p>

    <!-- Ajoutez d'autres sections selon vos besoins -->
  </section>

  <?php include '../../footer.php'; ?>


  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>