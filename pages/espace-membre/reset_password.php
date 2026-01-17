<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $email = trim($_POST['email']);
        $newPassword = trim($_POST['new_password']);
        $confirmPassword = trim($_POST['confirm_password']);

        if ($newPassword === $confirmPassword) {

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $db_server = 'rdbms.strato.de';
            $db_name = 'dbs12515927';
            $db_user = 'dbu5550532';
            $db_password = 'Baptwann!27190405';

            try {
                $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("UPDATE espace_membre SET motdepasse = :hashed_password WHERE mail = :email");
                $stmt->execute(['hashed_password' => $hashedPassword, 'email' => $email]);

                header('Location: http://127.0.0.1/em/pages/espace-membre/conexion.php');
                exit; 
            } catch(PDOException $e) {
                echo "Erreur de connexion à la base de données: " . $e->getMessage();
            }
        } else {
            echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="style.css">
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e5f3fe;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

.container {
    width: 100%;
    max-width: 400px;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    text-align: left;
}

input[type="password"], input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="password"]:focus, input[type="email"]:focus {
    border-color: #0056b3;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 86, 179, 0.3);
}

button {
    width: 100%;
    padding: 12px;
    background-color: black;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialisation du mot de passe</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" required>
            <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>
</body>
</html>
