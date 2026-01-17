<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: conexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $db_server = 'rdbms.strato.de';
    $db_name = 'dbs12515927';
    $db_user = 'dbu5550532';
    $db_password = 'Baptwann!27190405';

    try {
        $dbh = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    } catch (PDOException $e) {
        die('Connection not possible, please check data!: ' . $e->getMessage());
    }

    $idAdresse = $_POST['id'];

    $requete_suppression = $dbh->prepare("DELETE FROM adresses WHERE id = ?");
    $requete_suppression->bindParam(1, $idAdresse, PDO::PARAM_INT);
    $requete_suppression->execute();

    echo "Adresse supprimée avec succès.";
} else {
    echo "Erreur lors de la suppression de l'adresse.";
}
?>
