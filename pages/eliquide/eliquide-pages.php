<?php
session_start();
require "../../_header.php";

$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
  $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
  die('Connection not possible, please check data!: ' . $e->getMessage());
}

$user_id = $_SESSION['user_id'];

$requete = $dbh->prepare("SELECT * FROM espace_membre WHERE id = ?");
$requete->bindParam(1, $user_id, PDO::PARAM_INT);
$requete->execute();

$user = $requete->fetch(PDO::FETCH_ASSOC);


// Vérifiez si le paramètre 'id' existe dans l'URL
if (isset($_GET['id'])) {
  // Récupérez les informations du produit
  $product = $DB->query("SELECT * FROM products WHERE id=:id", [':id' => $_GET['id']]);
  $product = $product[0];

  // Récupérez les avis associés au produit
  $reviews = $DB->query("SELECT * FROM reviews WHERE product_id=:product_id ORDER BY created_at DESC", [':product_id' => $_GET['id']]);
}

// Traitement du formulaire d'avis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'], $_POST['author'], $_POST['content'])) {
  // Insérer l'avis dans la base de données
  $DB->query("INSERT INTO reviews (product_id, author, content) VALUES (:product_id, :author, :content)", [
    ':product_id' => $_GET['id'],
    ':author' => htmlspecialchars($_POST['author']),
    ':content' => htmlspecialchars($_POST['content']),
  ]);
  // Rafraîchir la page pour afficher le nouvel avis
  header("Location: produit.php?id=" . $_GET['id']);
  exit();
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
  <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
  <style>
    .reviews {
      margin-top: 40px;
      padding: 25px;
      background-color: #ffffff;
      border: 1px solid #dedede;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .reviews h3 {
      font-size: 26px;
      font-weight: 600;
      color: #333;
      margin-bottom: 25px;
    }

    .reviews ul {
      list-style: none;
      padding: 0;
    }

    .reviews li {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #ebebeb;
    }

    .reviews li:last-child {
      border-bottom: none;
    }

    .reviews li strong {
      font-size: 18px;
      color: #222;
      font-weight: 500;
    }

    .reviews li p {
      margin-top: 10px;
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .reviews li .date {
      font-size: 14px;
      color: #888;
      margin-top: 5px;
    }

    .add-review {
      margin-top: 30px;
      padding: 25px;
      background-color: #f7f7f7;
      border: 1px solid #dedede;
      border-radius: 8px;
    }

    .add-review input[type="text"] {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    .add-review input[type="text"]:focus {
      border-color: #007bff;
      outline: none;
    }

    .add-review button {
      padding: 12px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .add-review button:hover {
      background-color: #0056b3;
    }

    .add-review form {
      display: flex;
      flex-direction: column;
    }

    .add-review label {
      font-size: 16px;
      margin-bottom: 8px;
      color: #333;
    }

    .add-review h3 {
      font-size: 22px;
      font-weight: 500;
      color: #333;
      margin-bottom: 20px;
    }

    .add-review p {
      font-size: 16px;
      color: #666;
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
    <h1>
      <?= $product->name; ?>
    </h1>
  </header>

  <div class="eliquide-container">

    <h3 class="titre-eliquide">E liquide <?= $product->name; ?> 50 ml.</h3>
    <img class="eliquide" src="<?= $product->url_photo ?>" alt="image" />
    <p class="p-eliquide"><?= $product->paragraphe ?></p>
    <div class="btn-payer">
      <a href="../../addpanier.php?id=<?= $_GET["id"]; ?>" class="bouton-eliquide">Ajouter au panier</a>
      <a class="bouton-eliquide prix"><?= $product->price; ?>€</a>
    </div>
    <div class="reviewstyle">

      <div class="reviews">
        <h3>Avis des clients</h3>
        <?php if ($reviews): ?>
          <ul>
            <?php foreach ($reviews as $review): ?>
              <li>
                <strong><?= htmlspecialchars($review->author); ?></strong> (le
                <?= date('d/m/Y', strtotime($review->created_at)); ?>) :
                <p><?= htmlspecialchars($review->content); ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p>Aucun avis pour ce produit.</p>
        <?php endif; ?>
      </div>

      <div class="add-review">
        <h3>Laisser un avis</h3>
        <?php if (isset($_SESSION['user_id'])): ?>
          <form method="POST">
            <label for="author">Votre nom :</label>
            <b><?php echo htmlspecialchars($user['pseudo']); ?></b>
            <br>
            <label for="content">Votre avis :</label>
            <input id="content" name="content" type="text" required>
            <button type="submit">Envoyer</button>
          </form>
        <?php else: ?>
          <p>Vous devez être <a href="http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php">connecté</a> pour
            laisser un
            avis.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php include '../../footer.php'; ?>

  <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>