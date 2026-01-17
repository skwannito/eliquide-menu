<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
  <title>Conditions générales d'utilisation</title>

  <style>
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
    }

    p {
      margin-bottom: 15px;
    }
  </style>
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
    <!-- bar des menu -->
    <nav class="menu">
      <ul>
        <li>
          <input class="searchbar" type="search" placeholder="rerchercher" required id="search" value=""
            onchange="ouvrirpages()" />
        </li>

        <li><a href="http://127.0.0.1/em/">accueil</a></li>

        <li>
          <a href="http://127.0.0.1/em/pagesmenu-e-liquide.php">menu e-liquide</a>
        </li>
        <li>
          <a href="http://127.0.0.1/em/pageseliquide.php">e-liquide</a>
        </li>
        <li><a href="http://127.0.0.1/em/pagesCE.php">ce</a></li>
        <li><a href="http://127.0.0.1/em/pagespanier.php">panier</a></li>
        <li>
          <a href="http://127.0.0.1/em/pagesnous-contacter.php">contact</a>
        </li>
      </ul>
    </nav>
    <h1>Conditions générales d'utilisation</h1>
  </header>
  <div class="sections">
    <section>
      <h2>1. Acceptation des conditions d'utilisation</h2>
      <p>
        En utilisant ce site web, vous acceptez de vous conformer à ces
        Conditions générales d'utilisation. Si vous n'êtes pas d'accord avec
        l'une des clauses, veuillez ne pas utiliser ce site.
      </p>
    </section>

    <section>
      <h2>2. Compte et sécurité</h2>
      <p>
        Pour accéder à certaines fonctionnalités de ce site, vous devrez
        peut-être créer un compte. Vous êtes responsable de la confidentialité
        de vos informations de compte et de toutes les activités qui se
        produisent sous votre compte.
      </p>
    </section>

    <section>
      <h2>3. Commandes et paiements</h2>
      <p>
        En passant une commande sur ce site, vous garantissez que vous êtes
        autorisé à effectuer cet achat et acceptez de payer le prix indiqué, y
        compris les frais d'expédition applicables.
      </p>
    </section>

    <section>
      <h2>4. Politique de confidentialité</h2>
      <p>
        Nous respectons votre vie privée. Consultez notre
        <a href="http://127.0.0.1/em/pages/condition-generales/politique-de-confidentialite.php"><b
            style="text-decoration: underline">Politique de confidentialité</b></a>
        pour en savoir plus sur la manière dont nous collectons, utilisons et
        protégeons vos informations personnelles.
      </p>
    </section>

    <section>
      <h2>5. Modifications des conditions d'utilisation</h2>
      <p>
        Nous nous réservons le droit de modifier ces Conditions générales
        d'utilisation à tout moment. Les modifications prendront effet dès
        leur publication sur le site. Il est de votre responsabilité de
        consulter régulièrement ces conditions pour rester informé des
        changements.
      </p>
    </section>
  </div>
  <?php include '../../footer.php'; ?>

</body>
<script src="http://127.0.0.1/em/script.js"></script>

</html>