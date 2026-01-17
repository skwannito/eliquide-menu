<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

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

// Traitement du formulaire d'ajout d'adresse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresse = htmlspecialchars($_POST["adresse"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $code_postal = htmlspecialchars($_POST["code_postal"]);
    $pays = htmlspecialchars($_POST["pays"]);

    // Insérer l'adresse dans la base de données
    $requete_insertion = $dbh->prepare("INSERT INTO adresses (user_id, adresse, ville, code_postal, pays) VALUES (?, ?, ?, ?, ?)");
    $requete_insertion->bindParam(1, $user_id, PDO::PARAM_INT); // Associer l'adresse à l'utilisateur connecté
    $requete_insertion->bindParam(2, $adresse, PDO::PARAM_STR);
    $requete_insertion->bindParam(3, $ville, PDO::PARAM_STR);
    $requete_insertion->bindParam(4, $code_postal, PDO::PARAM_STR);
    $requete_insertion->bindParam(5, $pays, PDO::PARAM_STR);
    $requete_insertion->execute();
}

// Récupérer les adresses de l'utilisateur depuis la base de données
$requete_adresses = $dbh->prepare("SELECT * FROM adresses WHERE user_id = ?");
$requete_adresses->bindParam(1, $user_id, PDO::PARAM_INT);
$requete_adresses->execute();
$adresses = $requete_adresses->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes adresses</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body,
        html {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
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
            padding: 10px;
            border-radius: 10px;
        }

        .menu-items li a:hover {
            background-color: #1b1616;
        }


        main {
            flex: 1;
            padding: 20px;
        }

        .address-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .address-form label {
            display: block;
            margin-bottom: 8px;
        }

        .address-form input[type="text"],
        .address-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .address-form button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .address-form button:hover {
            background-color: #45a049;
        }

        .address-item {
            background-color: #f4f4f4;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-buttons button.edit {
            background-color: #4caf50;
            color: #fff;
        }

        .action-buttons button.delete {
            background-color: #f00;
            color: #fff;
        }

        .vosadresse {
            right: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>
                <?php echo $user['pseudo']; ?>
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
        <div class="address-form">
            <h2>Ajouter une nouvelle adresse</h2>
            <form action="" method="post">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>

                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required>

                <label for="code_postal">Code postal :</label>
                <input type="text" id="code_postal" name="code_postal" required>

                <label for="pays">Pays :</label>
                <select id="pays" name="pays" required>
                    <option value="France">France</option>
                    <option value="Belgique">Belgique</option>
                    <option value="Suisse">Suisse</option>
                    <option value="Allemagne">Allemagne</option>
                    <option value="Royaume-unis">Royaume-unis</option>
                    <option value="France (outre mer)">France (outre-mer)</option>
                    <option value="Pays bas">Pays-bas</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="Norvège">Norvège</option>
                    <option value="Finlande">Finlande</option>
                    <option value="Espagne">Espagne</option>
                    <option value="Italie">Italie</option>
                    <!-- Ajoutez d'autres options de pays si nécessaire -->
                </select>

                <button type="submit">Enregistrer l'adresse</button>
            </form>

        </div>
        <div class="vosadresse">
            <?php if (!empty($adresses)): ?>
                <h2>Vos adresses enregistrées :</h2>
                <?php foreach ($adresses as $adresse): ?>
                    <div class="address-item">
                        <div>
                            <p>
                                <?= $adresse['adresse'] ?>
                            </p>
                            <p>
                                <?= $adresse['ville'] ?>,
                                <?= $adresse['code_postal'] ?>
                            </p>
                            <p>
                                <?= $adresse['pays'] ?>
                            </p>
                        </div>
                        <div class="action-buttons">
                            <button class="edit" onclick="modifierAdresse(<?= $adresse['id'] ?>)">Modifier</button>
                            <button class="delete" onclick="supprimerAdresse(<?= $adresse['id'] ?>)">Supprimer</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune adresse enregistrée pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
    <script>
        function supprimerAdresse(idAdresse) {
            if (confirm("Voulez-vous vraiment supprimer cette adresse ?")) {
                // Envoi de la requête AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://127.0.0.1/eliquide-menu/pages/espace-membre/suppradresse.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Afficher la réponse de la suppression
                        alert(xhr.responseText);
                        // Actualiser la page après la suppression
                        window.location.reload();
                    }
                };
                xhr.send("id=" + idAdresse);
            }
        }
        // Fonction pour rediriger vers la page de modification avec l'ID de l'adresse
        function modifierAdresse(idAdresse) {
            window.location.href = 'modifieradresse.php?id=' + idAdresse;
        }
    </script>
</body>

</html>