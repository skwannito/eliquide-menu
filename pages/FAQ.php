<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ</title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />

  <style>
    main {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    h2 {
      color: #333;
    }

    .faq-item {
      margin-bottom: 20px;
    }

    .question {
      font-weight: bold;
      cursor: pointer;
      position: relative;
      padding-right: 20px;
      -webkit-user-select: none;
      /* pour les navigateurs basés sur WebKit (Chrome, Safari) */
      -moz-user-select: none;
      /* pour les navigateurs basés sur Gecko (Firefox) */
      -ms-user-select: none;
      /* pour Internet Explorer */
      user-select: none;
    }

    .question::after {
      content: "\25BC";
      /* flèche vers le bas Unicode */
      position: absolute;
      right: 0;
    }

    .answer {
      display: none;
      margin-top: 10px;
      -webkit-user-select: none;
      /* pour les navigateurs basés sur WebKit (Chrome, Safari) */
      -moz-user-select: none;
      /* pour les navigateurs basés sur Gecko (Firefox) */
      -ms-user-select: none;
      /* pour Internet Explorer */
      user-select: none;
    }

    .expanded::after {
      content: "\25B2";
      /* flèche vers le haut Unicode */
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

    <h1>FAQ - E liquide menu</h1>
  </header>

  <main>
    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(1)">
        1. Comment passer une commande?
      </div>
      <div class="answer" id="answer1">
        Vous pouvez passer une commande en ajoutant des produits à votre
        panier et en suivant le processus de paiement.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(2)">
        2. Quels modes de paiement acceptez-vous?
      </div>
      <div class="answer" id="answer2">
        Nous acceptons les paiements par carte de crédit et PayPal.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(3)">
        3. D'où viennent vos produits?
      </div>
      <div class="answer" id="answer3">
        Nos produits sont tous fabriqué en france avec des ingrédients 100%
        français.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(4)">
        4. Quels sont les avantages des e-liquides avec différents taux de
        nicotine ?
      </div>
      <div class="answer" id="answer4">
        Les e-liquides avec différents taux de nicotine offrent la possibilité
        de personnaliser votre expérience. Les taux plus élevés conviennent
        souvent aux fumeurs réguliers, tandis que les taux plus bas sont
        idéaux pour ceux qui cherchent à réduire leur consommation de
        nicotine.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(5)">
        5. Comment choisir le bon e-liquide en termes de saveurs ?
      </div>
      <div class="answer" id="answer5">
        Le choix du e-liquide dépend des préférences individuelles. Nous
        proposons une large gamme de saveurs, des classiques comme la menthe
        aux options plus audacieuses comme les fruits exotiques. Explorez et
        trouvez celle qui correspond le mieux à vos goûts.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(6)">
        6. Quelle est la durée de vie moyenne d'une batterie de cigarette
        électronique ?
      </div>
      <div class="answer" id="answer6">
        La durée de vie d'une batterie dépend de divers facteurs, mais en
        général, elles durent entre 300 et 500 cycles de charge. Il est
        recommandé de charger la batterie lorsque celle-ci est presque
        déchargée pour prolonger sa durée de vie.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(7)">
        7. Comment entretenir et nettoyer ma cigarette électronique ?
      </div>
      <div class="answer" id="answer7">
        Un entretien régulier est essentiel. Nettoyez le réservoir et les
        connexions périodiquement avec un chiffon sec. Remplacez les
        résistances usées et assurez-vous que la batterie est propre.
        Consultez notre guide d'entretien pour plus de détails.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(8)">
        8. Quelles sont les différences entre les types de résistances
        disponibles sur le marché ?
      </div>
      <div class="answer" id="answer8">
        Les résistances varient en termes de matériaux et d'ohms. Les
        résistances sub-ohm produisent plus de vapeur, tandis que les
        résistances à plus haute ohmicité sont idéales pour une inhalation
        indirecte. Choisissez en fonction de vos préférences de vapotage.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(9)">
        9. Proposez-vous des garanties sur vos produits ?
      </div>
      <div class="answer" id="answer9">
        Oui, nous offrons des garanties sur la plupart de nos produits.
        Consultez notre politique de garantie pour connaître les détails
        spécifiques. Nous nous engageons à fournir des produits de qualité et
        à assurer la satisfaction de nos clients.
      </div>
    </div>

    <div class="faq-item">
      <div class="question" onclick="toggleAnswer(10)">
        10. Quels conseils donneriez-vous aux utilisateurs novices pour
        maximiser leur expérience de vapotage ?
      </div>
      <div class="answer" id="answer10">
        Pour une expérience optimale, commencez par lire le manuel
        d'utilisation de votre cigarette électronique. Assurez-vous de bien
        comprendre le fonctionnement de votre appareil et suivez les
        recommandations du fabricant pour éviter tout problème. Explorez
        également différentes saveurs et ajustez les réglages selon vos
        préférences personnelles. N'hésitez pas à contacter notre service
        client si vous avez des questions spécifiques.
      </div>
    </div>

    <!-- Ajoutez d'autres questions/réponses selon vos besoins -->
  </main>
  <?php include '../footer.php'; ?>

  <script>
    function toggleAnswer(id) {
      var answer = document.getElementById("answer" + id);
      var question = document.querySelector(
        ".faq-item:nth-child(" + id + ") .question"
      );
      if (answer.style.display === "none") {
        answer.style.display = "block";
        question.classList.add("expanded");
      } else {
        answer.style.display = "none";
        question.classList.remove("expanded");
      }
    }
  </script>
  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>