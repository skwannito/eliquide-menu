<?php
require '_header.php';

if (isset($_GET["id"])) {
	$product = $DB->query("SELECT * FROM products WHERE id=:id", array("id" => $_GET["id"]));
	if (empty($product)) {
		$texte = "ce produit n'existe pas";
	}

	$panier->add($product[0]->id);
	$texte = "le produit a bien été ajouté au panier <a href='http://127.0.0.1/eliquide-menu/' style='text-decoration:underline;'>retourner au catalogue</a> ou <a href='http://127.0.0.1/eliquide-menu/pages/panier.php' style='text-decoration:underline;'>aller au panier</a>";
} else {
	$texte = "pas de produit";
}




?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ajouté au panier</title>
	<link rel="stylesheet" href="http://127.0.0.1/eliquide-menu/style_main.css">
	<style>
		body {
			margin: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			text-align: center;
		}

		.article-ajouter {
			border: 2px solid #ccc;
			border-radius: 10px;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
	</style>
</head>

<body>
	<div class="article-ajouter">
		<?= $texte ?>
	</div>
</body>


</html>