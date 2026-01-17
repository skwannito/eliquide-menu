<?php
session_start();

// Vérifie si l'utilisateur a déjà confirmé son âge dans la session actuelle
if (isset($_SESSION['age_confirmed']) && $_SESSION['age_confirmed'] === true) {
    header('Location: http://127.0.0.1/em/index.php'); // Redirige vers la page d'accueil si l'utilisateur a déjà confirmé son âge
    exit;
}

// Si l'utilisateur a confirmé son âge, enregistre une variable de session et redirige vers la page d'accueil
if (isset($_POST['confirm_age'])) {
    $_SESSION['age_confirmed'] = true;
    header('Location: http://127.0.0.1/em/index.php');
    exit;
}
if (isset($_SESSION['age_not_confirmed']) && $_SESSION['age_confirmed'] === true) {
    header('Location: google.fr'); // Redirige vers la page d'accueil si l'utilisateur a déjà confirmé son âge
    exit;
}
if (isset($_POST['confirm_not_age'])) {
    $_SESSION['age_not_confirmed'] = true;
    header('Location: http://google.fr');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'âge</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e0e0e0;
            /* Fond gris plus prononcé */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 40px;
            text-align: center;
        }

        .container img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            /* Centrer horizontalement */
            align-items: center;
            /* Centrer verticalement */
            flex-wrap: wrap;
            /* Gestion du retour à la ligne des boutons */
        }

        .btn {
            flex: 1;
            /* Chaque bouton prend autant de place */
            padding: 15px;
            /* Ajuster le padding pour centrer le texte verticalement */
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin: 5px;
            width: 100px;

        }

        .btn:hover {
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #dc3545;
        }

        .btn-secondary:hover {
            background-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="http://127.0.0.1/em/logo.png" alt="Logo">
        <h2>Vous avez plus de 18 ans ?</h2>
        <p><b>En entrant sur ce site, je reconnais être majeur(e) et que je suis autorisé(e) par la législation de mon
                pays à acheter des produits contenant de la nicotine.</b></p>
        <div class="btn-container">
            <form method="post">
                <button class="btn btn-primary" type="submit" name="confirm_age">Oui</button>
                <button class="btn btn-secondary" type="submit" name="confirm_not_age">Non</button>
            </form>
        </div>
        <p>La nicotine contenue dans ce produit crée une forte dépendance.</p>
        <p>Son utilisation par les non-fumeurs n’est pas recommandée</p>
    </div>
</body>

</html>