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

// Vérifier si l'identifiant de l'adresse à modifier a été envoyé en GET
if (isset($_GET['id'])) {
    $adresse_id = $_GET['id'];

    // Requête SQL pour récupérer les informations de l'adresse à modifier
    $requete_adresse = $dbh->prepare("SELECT * FROM adresses WHERE id = ?");
    $requete_adresse->bindParam(1, $adresse_id, PDO::PARAM_INT);
    $requete_adresse->execute();
    $adresse = $requete_adresse->fetch(PDO::FETCH_ASSOC);

    if (!$adresse) {
        // Adresse non trouvée, rediriger vers une page d'erreur ou afficher un message
        header("Location: erreur.php");
        exit();
    }
} else {
    // Identifiant de l'adresse non spécifié, rediriger vers une page d'erreur ou afficher un message
    header("Location: erreur.php");
    exit();
}

// Traitement du formulaire de modification d'adresse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresse_modifiee = htmlspecialchars($_POST["adresse"]);
    $ville_modifiee = htmlspecialchars($_POST["ville"]);
    $code_postal_modifie = htmlspecialchars($_POST["code_postal"]);
    $pays_modifie = htmlspecialchars($_POST["pays"]);

    // Requête SQL pour mettre à jour l'adresse dans la base de données
    $requete_modification = $dbh->prepare("UPDATE adresses SET adresse = ?, ville = ?, code_postal = ?, pays = ? WHERE id = ?");
    $requete_modification->bindParam(1, $adresse_modifiee, PDO::PARAM_STR);
    $requete_modification->bindParam(2, $ville_modifiee, PDO::PARAM_STR);
    $requete_modification->bindParam(3, $code_postal_modifie, PDO::PARAM_STR);
    $requete_modification->bindParam(4, $pays_modifie, PDO::PARAM_STR);
    $requete_modification->bindParam(5, $adresse_id, PDO::PARAM_INT);
    $requete_modification->execute();

    // Rediriger vers la page des adresses après la modification
    header("Location: adresse.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une adresse</title>
    <!-- Ajoutez ici vos styles CSS -->
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <style>
        /* Style pour placer le titre au-dessus du formulaire */
        .modify-address-container {
            text-align: center;
            margin-bottom: 20px;
            /* Ajoute un espace entre le titre et le formulaire */
        }
    </style>

    <!-- Titre "Modifier une adresse" -->
    <h2 class="modify-address-container">Modifier une adresse</h2>



    <form id="form-modifier-adresse" action="" method="post">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="<?= $adresse['adresse'] ?>" required>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="<?= $adresse['ville'] ?>" required>

        <label for="code_postal">Code postal :</label>
        <input type="text" id="code_postal" name="code_postal" value="<?= $adresse['code_postal'] ?>" required>

        <label for="pays">Pays :</label>
        <select id="pays" name="pays" required>
            <option value="France" <?= ($adresse['pays'] == 'France') ? 'selected' : '' ?>>France</option>
            <option value="Belgique" <?= ($adresse['pays'] == 'Belgique') ? 'selected' : '' ?>>Belgique</option>
            <option value="Suisse" <?= ($adresse['pays'] == 'Suisse') ? 'selected' : '' ?>>Suisse</option>
            <!-- Ajoutez d'autres options de pays si nécessaire -->
        </select>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <!-- Ajoutez ici votre script JavaScript -->
    <script>
        // Fonction pour soumettre le formulaire de modification d'adresse
        function modifierAdresse() {
            var form = document.getElementById('form-modifier-adresse');
            form.submit();
        }
    </script>
</body>

</html>