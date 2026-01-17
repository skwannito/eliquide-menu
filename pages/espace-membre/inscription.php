<?php
$success_mess = "";
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    die('Impossible de se connecter à la base de données, veuillez vérifier les données de connexion !: ' . $e->getMessage());
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST["Nom"]) ? htmlspecialchars($_POST["Nom"]) : "";
    $prenom = isset($_POST["Prénom"]) ? htmlspecialchars($_POST["Prénom"]) : "";
    $pseudo = isset($_POST["pseudo"]) ? htmlspecialchars($_POST["pseudo"]) : "";
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";

    $requete = $dbh->prepare("SELECT * FROM espace_membre WHERE mail = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();

    if ($password !== $confirmPassword) {
        $error_message = "Les mots de passe ne correspondent pas.";
    }
    if ($requete->rowCount() > 0) {
        $error_message = "L'adresse e-mail est déjà utilisée. Veuillez en choisir une autre.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $requete = $dbh->prepare("INSERT INTO espace_membre (pseudo, Prénom, mail, motdepasse, Nom) VALUES (:pseudo, :prenom, :email, :hashed_password, :nom)");

        $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);

        if ($requete->execute()) {
            $success_mess = "Inscription réussie!";

            $to = $email;
            $subject = "Bienvenue sur notre site !";

            $message = "
<html>
<head>
    <title>Bienvenue sur notre site !</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px;
            height: auto;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='logo'>
            <img src='http://127.0.0.1/em/logo.png' alt='Logo du site'>
        </div>
        <h2>Bienvenue, $prenom $nom !</h2>
        <p>Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir dans notre communauté.</p>
        <p>N'hésitez pas à explorer nos fonctionnalités et à découvrir nos produits nous vous offrons 5% de réduction
        sur votre première commande avec le code <b>BIENVENUE5 </b>. Si vous avez des questions, notre équipe de support est là pour vous aider.</p>
        <p>Nous espérons que vous apprécierez votre expérience avec nous.</p>
        <p>À très bientôt !</p>
        <div class='footer'>
            <p><a href='http://127.0.0.1/em'>Visitez notre site</a> | <a href='mailto:support@eliquide-menu.fr'>Contactez-nous</a></p>
        </div>
    </div>
</body>
</html>
";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: no-reply@eliquide-menu.fr' . "\r\n";

            mail($to, $subject, $message, $headers);

            header("Location: conexion.php");
        } else {
            echo "<h2>Erreur lors de l'inscription. Veuillez réessayer.</h2>";
        }

        $requete->closeCursor();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
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
            top: 35%;
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Inscription</h2>

        <?php
        if (!empty($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
        <label for="Nom">Nom:</label>
        <input type="text" id="Nom" name="Nom" required>

        <label for="Prénom">Prénom:</label>
        <input type="text" id="Prénom" name="Prénom" required>

        <label for="pseudo">Nom d'utilisateur:</label>
        <input type="text" id="pseudo" name="pseudo" required>

        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <div style="position: relative;">
            <input type="password" id="password" name="password" required>
            <img class="oeil" src="http://127.0.0.1/em/pages/espace-membre/img-password/voir.png" id="togglePassword"
                onclick="togglePasswordVisibility()">
        </div>

        <label for="confirmPassword">Confirmer le mot de passe:</label>
        <div style="position: relative;">
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <img class="oeil" src="http://127.0.0.1/em/pages/espace-membre/img-password/voir.png"
                id="toggleconfirmPassword" onclick="togglePasswordconfirmVisibility()">
        </div>

        <button type="submit">S'inscrire</button>
        <?php if ($success_mess): ?>
            <p style="color: green;">
                <?php echo $success_mess; ?>
            </p>
        <?php endif; ?>
        <br><br>
        <p><b>Vous avez déjà un compte ?<a href="http://127.0.0.1/em/pages/espace-membre/conexion.php"> se
                    connecter</a></b></p>
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
        function togglePasswordconfirmVisibility() {
            var passwordInput = document.getElementById('confirmPassword');
            var toggleIcon = document.getElementById('toggleconfirmPassword');

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