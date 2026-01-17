<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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

input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="email"]:focus {
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
    </style>
</head>
<body>
<a href="http://127.0.0.1/em/pages/espace-membre/conexion.php" style="position: absolute; top: 10px; left: 10px; text-decoration: none;
 color: #fff; font-weight: bold; background-color: #A9A9A9; padding: 8px 12px; border-radius: 4px;">Retour</a>
<div class="container">
        <h2>Mot de passe oublié</h2>
        <form action="send_code.php" method="post">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Envoyer le code de confirmation</button>
        </form>
    </div>
</body>
</html>
