<?php

session_start();

$db_server = 'localhost';
$db_name = 'dbs12515927';
$db_user = 'root';
$db_password = '';

try {
    // Connexion à la base de données
    $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    // Afficher les erreurs PDO
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'échec de connexion, afficher un message d'erreur
    die('Connection not possible, please check data!: ' . $e->getMessage());
}

// Supprimer la vérification $_POST['comfirmer']

// Insérer la commande dans la base de données
$user_id = $_SESSION['user_id'];
$numero_commande = generateUniqueOrderNumber();
$total = $prixtotal;
$statut = "en cours de traitement";

$requete_insertion = $dbh->prepare("INSERT INTO commande (user_id, numero_commande, total, statut) VALUES (?, ?, ?, ?)");
$requete_insertion->bindParam(1, $user_id, PDO::PARAM_INT);
$requete_insertion->bindParam(2, $numero_commande, PDO::PARAM_STR);
$requete_insertion->bindParam(3, $total, PDO::PARAM_STR);
$requete_insertion->bindParam(4, $statut, PDO::PARAM_STR);
$requete_insertion->execute();
