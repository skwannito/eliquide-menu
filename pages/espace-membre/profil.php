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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/pages/espace-membre/style-membre.css">
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
                <?php if ($user['id'] == 10 || $user['id'] == 13) { ?>
                    <li><a href="http://127.0.0.1/eliquide-menu/">Admin</a></li><?php } ?>
                <li><a href="http://127.0.0.1/eliquide-menu/">Allez au catalogue</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/profil.php">Mon profil</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/commandes.php">Historique des
                        commandes</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/favoris.php">Favoris</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/informations_personnelles.php">Informations
                        personnelles</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/adresse.php">Mes adresses</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/programme-fidelite.php">Mes points
                        fidélités</a>
                </li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/panier.php">Mon panier</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Profil de l'utilisateur</h2>
            </div>
            <div class="profile-info">
                <p>Bienvenue,
                    <?php echo $user['pseudo']; ?> !
                </p>
            </div>
        </div>
    </div>
</body>

</html>