<?php
if (!isset($_SESSION)) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Access data
$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';


// Connection
try {
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    die('Connection not possible, please check data!: ' . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];
 
    $requete = $dbh->prepare("SELECT * FROM espace_membre WHERE mail = ?");
    $requete->bindParam(1, $email, PDO::PARAM_STR);
    $requete->execute();

    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['motdepasse'])) {

        $_SESSION['user_id'] = $user['id'];
        if (isset($_SESSION["redirect"])) {
            $redirect = $_SESSION['redirect'];
            unset($_SESSION['redirect']);
            header("Location: " . $redirect);
        } else {
            header("Location: profil.php");
        }


        exit();
    } else {
        header("Location: conexion.php?error=1");
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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

form {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    max-width: 400px;
    width: 100%;
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

input[type="email"], input[type="password"], input[type="text"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus {
    border-color: #0056b3;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 86, 179, 0.3);
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: left;
}

.oeil {
    width: 25px;
    position: absolute;
    top: 40%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

a.retour {
    position: absolute;
    top: 10px;
    left: 10px;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    background-color: #A9A9A9;
    padding: 8px 12px;
    border-radius: 4px;
}
    </style>
</head>

<body>
    <a href="http://127.0.0.1/em/" style="position: absolute; top: 10px; left: 10px; text-decoration: none;
 color: #fff; font-weight: bold; background-color: #A9A9A9; padding: 8px 12px; border-radius: 4px;">Retour</a>
    <form action="conexion.php" method="post">

        <h2>Connexion</h2>

        <?php
        if (!empty($_GET['error'])) {
            echo '<p class="error">Identifiants incorrects. Veuillez réessayer.</p>';
        }
        ?>

        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
<div style="position: relative;">
    <input type="password" id="password" name="password" required>
    <img class="oeil" src="http://127.0.0.1/em/pages/espace-membre/img-password/voir.png" id="togglePassword"  onclick="togglePasswordVisibility()">
</div>

        <button type="submit">Se connecter</button>
        <br>
        <br>
        <p><a href="http://127.0.0.1/em/pages/espace-membre/motdepasseoublie.php">Mot de passe oublié ?</a></p>

        
        <p><b>pas de compte ? <a href="http://127.0.0.1/em/pages/espace-membre/inscription.php">inscription</a></b>
        </p>
    </form>

    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.src = 'http://127.0.0.1/em/pages/espace-membre/img-password/cacher.png';
        } else {
            passwordInput.type = 'password';
            toggleIcon.src = 'http://127.0.0.1/em/pages/espace-membre/img-password/voir.png';
        }
    }
</script>

</body>

</html>