<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (!isset($_SESSION)) {
    session_start();
}

// Configuration pour afficher les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires
require "../db.class.php";
require "../panier.class.php";
$DB = new DB();
$panier = new panier();

// Supprimer un produit du panier
if (isset($_GET["del"])) {
    $panier->del($_GET["del"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
}

// Ajouter un produit au panier
if (isset($_GET["add"])) {
    $panier->add($_GET["add"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
    exit;
}

// Retirer un produit du panier
if (isset($_GET["remove"])) {
    $panier->remove($_GET["remove"]);
    header("Location: http://127.0.0.1/eliquide-menu/pages/panier.php");
}

// Initialisation des variables pour les produits et le prix total
$products = array();
$prixtotal = 0;

if (isset($_SESSION["panier"]) && is_array($_SESSION["panier"])) {
    $ids = array_keys($_SESSION["panier"]);
    if (!empty($ids)) {
        $products = $DB->query("SELECT * FROM products WHERE id IN (" . implode(",", $ids) . ")");
        foreach ($products as $product) {
            $quantite = $_SESSION['panier'][$product->id];
            $prixtotal += $quantite * $product->price;
        }
    }
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect'] = "http://127.0.0.1/eliquide-menu/pages/passer-commande.php";
    header("Location: http://127.0.0.1/eliquide-menu/pages/espace-membre/conexion.php");
    exit();
}



$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection not possible, please check data!: ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enregistrer'])) {
    $user_id = $_SESSION['user_id'];
    $adresse = htmlspecialchars($_POST["nouvelle_adresse"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $code_postal = htmlspecialchars($_POST["code_postal"]);
    $pays = htmlspecialchars($_POST["pays"]);

    $requete_insertion = $dbh->prepare("INSERT INTO adresses (user_id, adresse, ville, code_postal, pays) VALUES (?, ?, ?, ?, ?)");
    $requete_insertion->bindParam(1, $user_id, PDO::PARAM_INT);
    $requete_insertion->bindParam(2, $adresse, PDO::PARAM_STR);
    $requete_insertion->bindParam(3, $ville, PDO::PARAM_STR);
    $requete_insertion->bindParam(4, $code_postal, PDO::PARAM_STR);
    $requete_insertion->bindParam(5, $pays, PDO::PARAM_STR);
    $requete_insertion->execute();


}
$user_id = $_SESSION['user_id'];
$requete_adresses = $dbh->prepare("SELECT * FROM adresses WHERE user_id = ?");
$requete_adresses->bindParam(1, $user_id, PDO::PARAM_INT);
$requete_adresses->execute();
$adresses = $requete_adresses->fetchAll(PDO::FETCH_ASSOC);

$stmt = $dbh->prepare("SELECT Nom, Prénom FROM espace_membre WHERE id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}

$nom = $user['Prénom'];
$prenom = $user["Nom"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer Commande</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select,
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .enregistrer {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .enregistrer:hover {
            background-color: #005F6B;
        }

        #retourPanierBtn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #ccc;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        #retourPanierBtn:hover {
            background-color: #aaa;
        }

        .article {
            display: inline-block;
            margin-right: 20px;
            vertical-align: top;
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

        .article {
            text-align: center;
            margin-right: 20px;
            display: inline-block;
        }

        .Total {
            text-align: center;
            padding: 7px;
            border: 2px solid #575757;
            border-radius: 5px;
            color: white;
            background-color: black;
            font-size: 16px;
        }

        .nomp {
            text-align: center;
        }

        .Titreh {
            border: 2px solid #d3ecff;
            background-color: #d3ecff;
            border-radius: 4px;
        }
    </style>

</head>

<body>
    <button id="retourPanierBtn" onclick="retourAuPanier()">Retour au panier</button>
    <div class="container">
        <div class="Titreh">
            <h1>Passer Commande</h1>
            <div class="nomp">
                <h3><?php echo $user['Prénom'] . " " . $user["Nom"]; ?></h3>
            </div>
        </div>
        <br>
        <form id="adresseForm" method="post">
            <label for="adresse"><b>Choisissez votre adresse :</b></label>
            <select name="adresse" id="adresse" required>

                <?php foreach ($adresses as $adresse): ?>
                    <option value="<?php echo $adresse["id"]; ?>">
                        <?php echo $adresse["adresse"] . " " . $adresse["ville"] . " " . $adresse["code_postal"] . " " . $adresse["pays"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="nouvelle_adresse"><b>Ou saisissez une nouvelle adresse :</b></label>
            <input type="text" id="nouvelle_adresse" name="nouvelle_adresse" placeholder="Adresse">
            <input type="text" id="ville" name="ville" placeholder="Ville">
            <input type="text" id="code_postal" name="code_postal" placeholder="Code Postal">
            <select id="pays" name="pays">
                <option value="France">France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <option value="France (outre mer)">France (outre-mer)</option>
            </select>
            <button class="enregistrer" type="submit" name="enregistrer">Enregistrer l'adresse</button>
            <br>
            <br>
        </form>
        <form id="payerForm" method="post">
            <br>
            <br>
            <label for="récapitulatif"><b> Récapitulatif de votre commande :</b></label>
            <?php foreach ($products as $product): ?>
                <div class="article">
                    <img src="<?= $product->url_photo; ?>" alt="" class="product-image">
                    <div class="product-name"><?= $product->name; ?></div>
                </div>
            <?php endforeach; ?>
            <br>
            <br>
            <h3 class="Total"><b>Total :<?php echo $prixtotal; ?>€ </b></h3>
            <div id="paypal-payment-button"></div>
        </form>
    </div>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AZY-4vbTNACScY7b5ppaMPe0pugfz2oCi7Al9mtBHsgchTbgqIZ45G-fGyx3XJOQVmVdYJB8YzU_fMIK&currency=EUR"></script>
    <?php
    ?>

    <script>
        paypal.Buttons({
            style: {
                color: 'blue'
            },
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $prixtotal; ?>'
                        }
                    }]
                })
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    console.log(details);
                    window.location.replace("success.php");
                })
            }

        }).render('#paypal-payment-button');
    </script>

    <script>
        function retourAuPanier() {
            window.location.href = "http://127.0.0.1/eliquide-menu/pages/panier.php";
        }
    </script>

</body>

</html>
<?php
function generateUniqueOrderNumber()
{
    return uniqid();
}
?>