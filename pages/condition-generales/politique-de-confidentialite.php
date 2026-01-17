<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
  <title>Politique de confidentialité</title>

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
    <h1>Politique de confidentialité</h1>
  </header>
  <div class="sections">
    <section>
      <h2>1. Collecte des informations</h2>
      <p>
        Nous recueillons des informations lorsque vous créez un compte, passez
        une commande ou interagissez avec notre site. Les informations
        collectées peuvent inclure votre nom, votre adresse e-mail, votre
        adresse de livraison, etc.
      </p>
    </section>

    <section>
      <h2>2. Utilisation des informations</h2>
      <p>
        Les informations que nous recueillons peuvent être utilisées pour
        traiter les commandes, personnaliser votre expérience, améliorer notre
        site et vous envoyer des communications marketing.
      </p>
    </section>

    <section>
      <h2>3. Protection des informations</h2>
      <p>
        Nous mettons en œuvre une variété de mesures de sécurité pour
        préserver la sécurité de vos informations personnelles. Nous ne
        vendons, n'échangeons ni ne transférons vos informations à des tiers
        sans votre consentement.
      </p>
    </section>

    <section>
      <h2>4. Divulgation à des tiers</h2>
      <p>
        Nous ne divulguons pas vos informations personnelles identifiables à
        des tiers sans votre consentement, sauf si cela est nécessaire pour
        fournir un service, respecter la loi ou protéger nos droits.
      </p>
    </section>

    <section>
      <h2>5. Cookies</h2>
      <p>
        Nous utilisons des cookies pour améliorer votre expérience sur notre
        site. Vous pouvez désactiver les cookies dans les paramètres de votre
        navigateur, mais cela peut affecter certaines fonctionnalités du site.
      </p>
    </section>

    <section>
      <h2>6. Modifications de la politique de confidentialité</h2>
      <p>
        Nous nous réservons le droit de modifier notre politique de
        confidentialité à tout moment. Les modifications prendront effet dès
        leur publication sur le site.
      </p>
    </section>
  </div>
  <?php include '../../footer.php'; ?>

</body>
<script src="http://127.0.0.1/em/script.js"></script>

</html>