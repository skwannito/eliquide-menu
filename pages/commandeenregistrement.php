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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['retour_boutique'])) {
    // Insérer la commande dans la base de données
    try {
        // Générer un numéro de commande aléatoire entre 100000 et 999999
        $numero_commande = rand(100000, 999999999);

        // Récupérer l'identifiant de l'utilisateur, vous devez définir cette variable correctement
        $user_id = $id; // Mettez ici l'identifiant de l'utilisateur

        // Insérer les informations de la commande dans la base de données
        $requete_insertion_commande = $dbh->prepare("INSERT INTO commande (user_id, numero_commande, etat_commande) VALUES (?, ?, 'En cours')");
        $requete_insertion_commande->bindParam(1, $user_id, PDO::PARAM_INT);
        $requete_insertion_commande->bindParam(2, $numero_commande, PDO::PARAM_STR);
        // Exécuter la requête
        $requete_insertion_commande->execute();
    } catch (PDOException $e) {
        // Gérer les erreurs PDO ici
        echo "Erreur: " . $e->getMessage();
    }
}

