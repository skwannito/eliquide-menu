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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            margin-top: 10px;
            color: #555;
        }

        .logout-btn {
            background-color: #f00;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #d00;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        li a {
            display: inline-block;
            background-color: #2a2424;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        li a:hover {
            background-color: #1b1616;
        }
    </style>
</head>

<body>
    <a href="http://127.0.0.1/em/" style="position: absolute; top: 10px; left: 10px; text-decoration: none;
 color: #fff; font-weight: bold; background-color: #A9A9A9; padding: 8px 12px; border-radius: 4px;">Acceuil</a>

    <div class="profile-container">
        <h2>Profil de l'utilisateur</h2>
        <p>Bienvenue, <?php echo $user['pseudo']; ?> !</p>

        <!-- Liens vers les différentes sections -->
        <ul>
            <li><a href="http://127.0.0.1/em/pages/espace-membre/commandes.php">Historique des commandes</a></li>
            <li><a href="http://127.0.0.1/em/pages/espace-membre/informations_personnelles.php">Informations
                    personnelles</a></li>
            <li><a href="http://127.0.0.1/em/pages/espace-membre/adresse.php">Mes adresses</a></li>
            <li><a href="http://127.0.0.1/em/pages/programme-fidelite.php">Mes points fidélités</a></li>
            <li><a href="http://127.0.0.1/em/pages/panier.php">Mon panier</a></li>
        </ul>

        <button class="logout-btn" onclick="window.location='logout.php'">Se déconnecter</button>
    </div>
</body>

</html>