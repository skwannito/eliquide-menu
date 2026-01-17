<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

// Connexion à la base de données
$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $user_id = $_SESSION['user_id'];

    $stmt = $dbh->prepare("SELECT pseudo FROM espace_membre WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Sélectionner les commandes de l'utilisateur
    $stmt = $dbh->prepare("SELECT * FROM commande WHERE user_id = :user_id ORDER BY date_commande DESC");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des commandes ont été trouvées
    if (!$commandes) {
        $message = "Aucune commande trouvée.";
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Commandes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #dbedfa;
            color: #000000;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
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

        .orders-history {
            margin-bottom: 50px;
        }

        .orders-history h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f9f9f9;
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
                <li><a href="http://127.0.0.1/em/">Allez au catalogue</a></li>
                <li><a href="http://127.0.0.1/em/pages/espace-membre/profil.php">Mon profil</a></li>
                <li><a href="http://127.0.0.1/em/pages/espace-membre/commandes.php">Historique des commandes</a>
                </li>
                <li><a href="http://127.0.0.1/em/pages/espace-membre/favoris.php">Favoris</a></li>

                <li><a href="http://127.0.0.1/em/pages/espace-membre/informations_personnelles.php">Informations
                        personnelles</a></li>
                <li><a href="http://127.0.0.1/em/pages/espace-membre/adresse.php">Mes adresses</a></li>
                <li><a href="http://127.0.0.1/em/pages/espace-membre/programme-fidelite.php">Mes points
                        fidélités</a></li>
                <li><a href="http://127.0.0.1/em/pages/panier.php">Mon panier</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>
        </div>
        <div class="content">
            <section class="orders-history">
                <h2>Historique de vos Commandes</h2>
                <?php if (isset($message)): ?>
                    <p>
                        <?= $message ?>
                    </p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Numéro de Commande</th>
                                <th>Total</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $commande): ?>
                                <tr>
                                    <td>
                                        <?= $commande['date_commande'] ?>
                                    </td>
                                    <td>
                                        <?= $commande['numero_commande'] ?>
                                    </td>
                                    <td>
                                        <?= $commande['total'] ?> €
                                    </td>
                                    <td style="color: green;">
                                        <b><?= $commande['statut'] ?></b>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
        </div>
    </main>
</body>

</html>