<?php
$host = 'localhost';
$dbname = 'dbs12515927';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "✅ Connexion réussie à la base de données.";
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
?>