<?php
if (!isset($_SESSION)) {
  session_start();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);


require "../db.class.php";
require "../panier.class.php";
$DB = new DB();
$panier = new panier();
if (isset($_GET["del"])) {
  $panier->del($_GET["del"]);
  header("Location : http://127.0.0.1/em/pages/panier.php");
}
if (isset($_GET["add"])) {
  $panier->add($_GET["add"]);
  header("Location : http://127.0.0.1/em/pages/panier.php");
  exit;
}
if (isset($_GET["remove"])) {
  $panier->remove($_GET["remove"]);
  header("Location : http://127.0.0.1/em/pages/panier.php");

}
if (isset($_SESSION["panier"])) {
  $ids = array_keys($_SESSION["panier"]);
  if (empty($ids)) {
    $products = array();
  } else {
    $products = $DB->query("SELECT * FROM products WHERE id IN (" . implode(",", $ids) . ")");
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>panier</title>
  <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
</head>
<style>
  .panier-container {
    width: 80%;
    margin: 30px auto;
    min-height: 100px;
    background-color: #d3ecff;
    border: 1px solid grey;
    padding: 10px;
  }

  .info-panier-container {
    min-height: 50px;
    background-color: #d3ecff;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    font-weight: bold;
    padding: 10px;
  }

  .info-panier-container div {
    border: 1px solid grey;
    padding: 10px;
    text-align: center;
  }

  .article-container {
    min-height: 50px;
    background-color: #d3ecff;
    border-top: 0;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    padding: 10px;
  }

  .article-container div {
    border: 1px solid grey;
    min-height: 50px;
    padding: 10px;
  }

  .sous-total {
    min-height: 50px;
    background-color: #d3ecff;
    display: grid;
    grid-template-columns: 3fr 1fr;
    padding: 10px;
    font-weight: bold;
  }

  .sous-total div {
    min-height: 50px;
    background-color: #d3ecff;
    border: 1px solid grey;
    padding: 10px;
    text-align: right;
  }

  .article-name {
    display: flex;
    align-items: center;
  }

  .article-name img {
    margin-right: 10px;
    border: 1px solid black;
    border-radius: 5px;
  }


  .payer {
    display: block;
    color: white;
    text-align: center;
    background-color: black;
    border-radius: 8px;
    padding: 10px 50px;

  }

  .payer-container {
    display: flex;
    justify-content: center;
  }
</style>

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
    <h1>Panier</h1>
  </header>

  <div class="panier-container">
    <div class="info-panier-container">
      <div class="info-panier">article</div>
      <div class="info-panier">prix</div>
      <div class="info-panier">quantité</div>
      <div class="info-panier">Total</div>
    </div>

    <?php
    $prixtotal = 0;
    if (isset($_SESSION["panier"]) && is_array($_SESSION["panier"])) {
      foreach ($products as $product):
        $quantity = $_SESSION['panier'][$product->id];
        $category = $product->categorie;
        switch ($category) {
          case 'menu':
            $productURL = 'http://127.0.0.1/em/pages/menu/menu-pages.php?id=' . $product->id;
            break;
          case 'ce':
            $productURL = 'http://127.0.0.1/em/pages/CE/CE-pages.php?id=' . $product->id;
            break;
          case 'eliquide':
            $productURL = 'http://127.0.0.1/em/pages/eliquide/eliquide-pages.php?id=' . $product->id;
            break;
          default:
            $productURL = '#';
        }
        ?>
        <div class="article-container">
          <div class="article-name">
            <img src="<?= $product->url_photo; ?>" alt="" style="width: 80px;">
            <a href="<?= $productURL ?>">
              <?= $product->name; ?>
            </a>
          </div>
          <div class="article-price">
            <?= $product->price; ?>€
          </div>
          <div class="article-quantite">


            <a href="http://127.0.0.1/em/pages/panier.php?remove=<?= $product->id ?>" style="font-size:30px;">⇦</a>
            <span>
              <?php echo $quantity; ?>
            </span><a href="http://127.0.0.1/em/pages/panier.php?add=<?= $product->id ?>" style="font-size:30px;">⇨</a>

          </div>
          <div class="article-total">
            <?= $product->price * $quantity; ?>€
            <a href="http://127.0.0.1/em/pages/panier.php?del=<?= $product->id ?>" style="font-size:30px;"><img
                src="http://127.0.0.1/em/img-main/poubelle.png" alt="" style="width: 20px;"></a>
          </div>
        </div>
        <?php
        $prixtotal += $quantity * $product->price;
      endforeach;
    }
    ?>
    <div class="sous-total">
      <div></div>
      <div>
        <?= $prixtotal; ?>€
      </div>
    </div>

  </div>
  <div class="payer-container">
    <?php if (!empty($_SESSION["panier"]) && is_array($_SESSION["panier"])): ?>
      <a class="payer" href="http://127.0.0.1/em/pages/passer-commande.php">Payer</a>
    <?php else: ?>
      <span class="payer" style="background-color: gray; cursor: not-allowed;">Payer</span>
    <?php endif; ?>
  </div>

  <?php include '../footer.php'; ?>

</body>
<script src="http://127.0.0.1/em/script.js"></script>


</html>