<?php
session_start();

// Informations de connexion à la base de données
$host = 'rdbms.strato.de';
$db_name = 'dbs12515927';
$db_user = 'dbu5550532';
$db_password = 'Baptwann!27190405';

try {
    // Connexion à la base de données
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
    exit;
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['message' => 'Vous devez être connecté pour ajouter des favoris.']);
    exit;
}

// Vérifier les données POST
if (!isset($_POST['product_id']) || !isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Données invalides.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$action = $_POST['action'];

try {
    if ($action == 'add') {
        $product_name = $_POST['product_name'];
        $product_image = $_POST['product_image'];

        $stmt = $db->prepare("INSERT INTO favorites (user_id, product_id, product_name, product_image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $product_name, $product_image]);
        echo json_encode(['success' => true]);
    } elseif ($action == 'remove') {
        $stmt = $db->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Action non reconnue.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erreur lors de la mise à jour des favoris : ' . $e->getMessage()]);
}

