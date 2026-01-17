<?php
session_start();

// Assurez-vous que la session est démarrée

if (!isset($_SESSION)) {
    session_start();
}

// Paramètres pour afficher les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires
require "../db.class.php";
require "../panier.class.php";
$DB = new DB();
$panier = new panier();

// Supprimer un produit du panier si nécessaire
if (isset($_GET["del"])) {
    $panier->del($_GET["del"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
}

// Ajouter un produit au panier si nécessaire
if (isset($_GET["add"])) {
    $panier->add($_GET["add"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
    exit;
}

// Retirer un produit du panier si nécessaire
if (isset($_GET["remove"])) {
    $panier->remove($_GET["remove"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
}

// Initialiser les variables pour les produits et le prix total
$products = array();
$prixtotal = 0;

// Vérifier si le panier existe dans la session et s'il contient des éléments
if (isset($_SESSION["panier"]) && is_array($_SESSION["panier"])) {
    $ids = array_keys($_SESSION["panier"]);
    if (!empty($ids)) {
        // Récupérer les détails des produits à partir de la base de données
        $products = $DB->query("SELECT * FROM products WHERE id IN (" . implode(",", $ids) . ")");

        // Calculer le prix total des produits dans le panier
        foreach ($products as $product) {
            $quantite = $_SESSION['panier'][$product->id];
            $prixtotal += $quantite * $product->price;
        }
    }
}
$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

// Enregistrer la commande dans la base de données
if (isset($_SESSION['user_id'])) {
    try {

        // Connexion à la base de données
        $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête d'insertion
        $user_id = $_SESSION['user_id'];
        $numero_commande = generateUniqueOrderNumber();
        $statut = "en cours de traitement";
        $produits = "";

        // Création de la liste des produits commandés
        foreach ($products as $product) {
            $produits .= $product->name . ", ";
        }
        $produits = rtrim($produits, ", ");

        // Exécution de la requête d'insertion
        $requete_insertion = $dbh->prepare("INSERT INTO commande (user_id, numero_commande, total, statut, produits) VALUES (?, ?, ?, ?, ?)");
        $requete_insertion->bindParam(1, $user_id, PDO::PARAM_INT);
        $requete_insertion->bindParam(2, $numero_commande, PDO::PARAM_STR);
        $requete_insertion->bindParam(3, $prixtotal, PDO::PARAM_STR);
        $requete_insertion->bindParam(4, $statut, PDO::PARAM_STR);
        $requete_insertion->bindParam(5, $produits, PDO::PARAM_STR);
        $requete_insertion->execute();
    } catch (PDOException $e) {
        die('Connection not possible, please check data!: ' . $e->getMessage());
    }
}

// Fonction pour générer un numéro de commande unique
function generateUniqueOrderNumber()
{
    return uniqid(); // Exemple de génération de numéro de commande unique
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
            outline: none;
            font-family: "Montserrat";
        }

        .bloc {
            box-shadow: 0px 22px 40px -8px grey;
            border-radius: 8px;
            max-width: 750px;
            margin: 50px auto 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .bloc .success-logo {
            text-align: center;
        }

        .bloc .success-logo img {
            max-width: 50px;
        }

        .bloc h1 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            color: rgb(47, 47, 47);
        }

        .bloc p {
            color: rgb(87, 87, 87);
            text-align: center;
        }

        .bloc .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bloc .return {
            text-align: center;
            background: #0070ba;
            text-transform: uppercase;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            display: inline-block;
            margin-top: 30px;
        }

        .recap {
            text-align: center;
        }

        .article {
            text-align: center;
            margin-right: 20px;
            display: inline-block;
        }

        .product-image {
            width: 80px;
            border: 2px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
        }

        .product-name {
            font-size: 14px;
            color: brown;
            font-weight: bold;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="bloc">
        <div class="success-logo">
            <img src="http://127.0.0.1/eliquide-menu/pages/espace-membre/img-password/imgsucess/check_mark.png">
        </div>
        <h1 class="font-title">Merci pour votre achat !</h1>
        <p>Nous vous avertirons lorsque votre commande sera envoyée.</p>
        <br>
        <p>Vous pouvez suivre l'avancer de votre commande dans votre espace membre.</p>
        <br>
        <p>Si vous avez la moindre questions contactez nous dans notre rubrique SAV.</p>
        <br>
        <div><b>
                <p>Récapitulatif de la commande :</p>
            </b></div>
        <br>
        <?php foreach ($products as $product): ?>
            <div class="article">
                <img src="<?= $product->url_photo; ?>" alt="" class="product-image">
                <div class="product-name"><?= $product->name; ?></div>
            </div>
        <?php endforeach; ?>
        <div class="center">
            <a class="return" href="http://127.0.0.1/em" onclick="clearCart()">Retour à la boutique</a>

        </div>
    </div>

    <script>
        function clearCart() {
            // Effacer les données de la session du panier en utilisant une requête AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "clear_cart.php", true);
            xhr.send();
        }
    </script>

</body>

</html>
<?php
// Fonction pour générer un numéro de commande unique
?>