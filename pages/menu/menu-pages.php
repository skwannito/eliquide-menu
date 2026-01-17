<?php
session_start();
require "../../_header.php";

// Vérifiez si le paramètre 'id' existe dans l'URL
if (isset($_GET['id'])) {
  // Récupérez la valeur de 'id'
  $product = $DB->query("SELECT * FROM products WHERE id=:id", [':id' => $_GET['id']]);
  $product = $product[0];
}
// Chemin du répertoire
$directory = 'menu-img/' . $product->id . '/';


// Vérifier si le répertoire peut être ouvert
if (is_dir($directory)) {
  // Obtenir la liste des fichiers dans le répertoire
  $files = scandir($directory);

  // Filtrer les fichiers d'image
  $imageFiles = array_filter($files, function ($file) {
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $allowedExtensions);
  });

  // Afficher chaque fichier d'image

} else {
  echo "Erreur: Impossible d'ouvrir le répertoire.";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $product->name; ?>
  </title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
  <!-- Ajoutez les styles CSS de Slick Slider -->
  <link rel="stylesheet" type="text/css" href="http://127.0.0.1/em/pages/slick-master/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="http://127.0.0.1/em/pages/slick-master/slick/slick-theme.css">
  <style>
    /* Styles personnalisés pour le slider */
    .slider-1 {
      max-width: 400px;

      margin: 100px auto;
      overflow: hidden;
      border: 1px solid white;
    }

    .slider-1 .slider {
      display: flex;
      animation: slider-anim 30s infinite ease-in-out;
    }

    .slider-1 img {

      flex-shrink: 0;
      padding: 0 0;
      width: 100%;
      object-fit: cover;
      object-position: left center;
    }

    @keyframes slider-anim {

      0%,
      9.09% {
        transform: translateX(0);
      }

      10%,
      20% {
        transform: translateX(-100%);
      }

      21%,
      30% {
        transform: translateX(-200%);
      }

      31%,
      40% {
        transform: translateX(-300%);
      }

      41%,
      50% {
        transform: translateX(-400%);
      }

      51%,
      60% {
        transform: translateX(-500%);
      }

      61%,
      70% {
        transform: translateX(-600%);
      }

      71%,
      80% {
        transform: translateX(-700%);
      }

      81%,
      90% {
        transform: translateX(-800%);
      }

      91%,
      100% {
        transform: translateX(-1000%);
      }
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
    <h1>
      <?= $product->name; ?>
    </h1>
  </header>

  <div class="eliquide-container">
    <h3 class="titre-eliquide">
      <?= $product->name; ?> 100 ml.
    </h3>
    <div class="slider-container slider-1">
      <div class="slider">
        <img src="<?= $product->url_photo ?>" alt="<?= $product->name; ?>" />
        <?php foreach ($imageFiles as $imageFile) {
          $imagePath = $directory . $imageFile;
          echo '<img src="' . $imagePath . '" alt="' . $imageFile . '" /><br>';
        } ?>

      </div>
    </div>

    <!-- Le reste de votre contenu HTML -->
    <h2 style="text-align: center; text-decoration: underline">
      Votre Menu :
    </h2>
    <div class="menu-eliquide">
      <?= $product->paragraphe ?>
    </div>
    <div class="btn-payer">
      <a href="../../addpanier.php?id=<?= $_GET["id"]; ?>" class="bouton-eliquide">Ajouter au panier</a>
      <a class="bouton-eliquide prix">
        <?= $product->price; ?>€
      </a>
    </div>
  </div>

  <?php include '../../footer.php'; ?>

  <!-- Scripts JavaScript -->
  <script src="http://127.0.0.1/em/pages/slick-master/slick/slick.js"></script>
  <!-- Ajoutez le script de Slick Slider -->
  <script src="http://127.0.0.1/em/pages/slick-master/slick/slick.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.slider').slick({
        autoplay: true, // Active l'autoplay si nécessaire
        arrows: true, // Affiche les flèches de navigation
        dots: true // Affiche les points de pagination
      });
    });
  </script>
  <script src="http://127.0.0.1/em/script.js"></script>
</body>

</html>