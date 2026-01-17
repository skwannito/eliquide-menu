<?php
// Démarrez la session
session_start();

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le code de confirmation est correct
    if (isset($_POST['code'])) {
        // Récupérez le code de confirmation saisi par l'utilisateur
        $userCode = $_POST['code'];
        
        // Vérifiez si le code de confirmation correspond à celui stocké dans la session
        if (isset($_SESSION['confirmation_code']) && $_SESSION['confirmation_code'] == $userCode) {
            // Le code de confirmation est correct, redirigez l'utilisateur vers la page de réinitialisation du mot de passe
            header('Location: reset_password.php');
            exit; // Arrêtez l'exécution du script après la redirection
        } else {
            // Le code de confirmation est incorrect, affichez un message d'erreur
            $errorMessage = "Code de confirmation incorrect";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie du code de confirmation</title>
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

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="password"]:focus {
    border-color: #0056b3;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 86, 179, 0.3);
}

button {
    width: 100%;
    padding: 12px;
    background-color: #000;
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

.error-message {
    color: red;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 20px;
    text-align: left;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Saisie du code de confirmation</h2>
        <?php if(isset($errorMessage)): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            <label for="code">Code de confirmation :</label>
            <input type="text" id="code" name="code" required >
            <button type="submit">Valider</button>
        </form>
    </div>
</body>
</html>
