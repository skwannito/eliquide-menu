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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css" />
    <title>Programme de Fidélité</title>

    <style>
        body,
        html {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .sidebar {
            width: 300px;
            background-color: #2a2424;
            color: #fff;
            padding: 20px;
        }

        .sidebar-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #fff;
            padding-bottom: 10px;
            text-decoration: none"

        }

        .menu-items {
            list-style-type: none;
            padding: 0;
        }

        .menu-items li {
            margin-bottom: 10px;
        }

        .menu-items li a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 0;
        }

        .menu-items li a:hover {
            background-color: #1b1616;
        }


        main {
            flex: 1;
            padding: 20px;
        }



        .loyalty-program {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            justify-content: center;
            /* Alignez le contenu horizontalement au centre */
            align-items: center;
            /* Alignez le contenu verticalement au centre */
        }


        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .reward {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>
                <?= $user['pseudo']; ?>
            </h2>
        </div>
        <ul class="menu-items">
            <li><a href="http://127.0.0.1/eliquide-menu/">Allez au catalogue</a></li>
            <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/profil.php">Mon profil</a></li>
            <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/commandes.php">Historique des commandes</a>
            </li>
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
    <main>
        <div class="loyalty-program">
            <p>Au bout de 50 points, vous recevrez 5 euros de réduction !</p>

            <div class="loyalty-points">
                <p>Vos points actuels: <span id="loyalty-points">
                        <?= $user['pts_fidelite'] ?>
                    </span></p>
            </div>

            <button>
                <a href="http://127.0.0.1/eliquide-menu/pages/panier.php">Accéder au panier</a>
            </button>

            <div class="reward">
                <p>
                    Réduction de 5 euros disponible:
                    <span id="reward-available">Non</span>
                </p>
                <button>Réclamer la réduction</button>
            </div>
        </div>
    </main>


    <script src="http://127.0.0.1/eliquide-menu/script.js"></script>
</body>

</html>