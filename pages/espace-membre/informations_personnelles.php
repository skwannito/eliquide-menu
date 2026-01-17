<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

// Récupérer les informations personnelles de l'utilisateur depuis la base de données
$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    // Sélectionner les informations de l'utilisateur
    $stmt = $dbh->prepare("SELECT pseudo, mail, Nom, Prénom FROM espace_membre WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe
    if (!$user) {
        echo "Utilisateur introuvable.";
        exit();
    }

    $dbh = null;
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

$pseudo = $user['pseudo'];
$email = $user['mail'];
$nom = $user['Prénom'];
$prenom = $user["Nom"];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Personnelles</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header,
        footer {
            background-color: #dbedfa;
            color: #000000;
            text-align: center;
            padding: 20px 0;
        }

        main {
            display: flex;
            height: 100vh;
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
            padding: 10px;
            border-radius: 10px;
        }

        .menu-items li a:hover {
            background-color: #1b1616;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .logout-btn {
            background-color: #f00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #d00;
        }


        .personal-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .info-item {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        span {
            display: block;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <main>
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
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/favoris.php">Favoris</a></li>

                </li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/informations_personnelles.php">Informations
                        personnelles</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/adresse.php">Mes adresses</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/espace-membre/programme-fidelite.php">Mes points
                        fidélités</a></li>
                <li><a href="http://127.0.0.1/eliquide-menu/pages/panier.php">Mon panier</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>
        </div>
        <div class="content">
            <section class="personal-info">
                <h2>Mes Informations Personnelles</h2>
                <div class="info-item">
                    <label for="Nom">Nom :</label>
                    <span id="Nom">
                        <?= $nom ?>
                    </span>
                </div>
                <div class="info-item">
                    <label for="Prénom">Prénom :</label>
                    <span id="Prénom">
                        <?= $prenom ?>
                    </span>
                </div>

                <div class="info-item">
                    <label for="pseudo">Pseudo :</label>
                    <span id="pseudo">
                        <?= $pseudo ?>
                    </span>
                </div>
                <div class="info-item">
                    <label for="email">Email :</label>
                    <span id="email">
                        <?= $email ?>
                    </span>
                </div>


            </section>
        </div>
    </main>

</body>

</html>