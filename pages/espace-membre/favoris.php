<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: conexion.php");
    exit();
}

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

if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}

// Récupérer les produits favoris de l'utilisateur
$requeteFavoris = $dbh->prepare("SELECT * FROM favorites WHERE user_id = ?");
$requeteFavoris->bindParam(1, $user_id, PDO::PARAM_INT);
$requeteFavoris->execute();
$favoris = $requeteFavoris->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/pages/espace-membre/style-membre.css">
    <style>
        .favoris-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .favoris-section {
            text-align: center;

        }

        .favori-item {
            width: 200px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .favori-item:hover {
            transform: translateY(-5px);
        }

        .favori-item img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #e0e0e0;
        }

        .favori-item-content {
            padding: 10px;
        }

        .favori-item-title {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .favori-item-description {
            font-size: 14px;
            color: #666;
        }

        .favori-item-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>
                    <?php echo $user['pseudo']; ?>
                </h2>
            </div>
            <ul class="menu-items">
                <li><a href="http://127.0.0.1/eliquide-menu/">Allez au catalogue</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/profil.php">Mon profil</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/commandes.php">Historique des
                        commandes</a>
                </li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/favoris.php">Favoris</a></li>

                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/informations_personnelles.php">Informations
                        personnelles</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/adresse.php">Mes adresses</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/programme-fidelite.php">Mes points
                        fidélités</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/panier.php">Mon panier</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>

        </div>

        <!-- Section pour afficher les produits favoris -->
        <div class="favoris-section">
            <h2>Produits favoris</h2>
            <div class="favoris-container">
                <?php foreach ($favoris as $favori): ?>
                    <div class="favori-item">
                        <h3><?= $favori['product_name'] ?></h3>
                        <img src="<?= $favori['product_image'] ?>" alt="<?= $favori['product_name'] ?>">
                        <!-- Vous pouvez afficher d'autres informations sur le produit ici -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>