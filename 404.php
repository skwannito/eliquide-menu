<?php if (!isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 NOT FOUND</title>
  <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .imgnotfound {
      width: 50vh;
      /* 50% de la largeur de la vue (viewport width) */
      height: 50vh;
      /* 50% de la hauteur de la vue (viewport height) */
      object-fit: cover;
      margin: auto;
      /* Centre horizontalement */
    }

    p a:hover {
      color: #6e6e6e;
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
    <h1>404 Not Found</h1>
  </header>
  <img class="imgnotfound" src="http://127.0.0.1/eliquide-menu/img-main/404notfound.jpg" alt="" />
  <p>
    désolé nous ne pouvons acceder à votre requete.
    <a href="http://127.0.0.1/eliquide-menu/">Retournez à l'accueil
      <img src="http://127.0.0.1/eliquide-menu/img-main/fleche-directionnelle.jpg" alt=""
        style="display: inline; width: 10px" /></a>
  </p>

  <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>