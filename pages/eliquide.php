<?php
session_start();
require "../_header.php";
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION['user_id'];
}
function truncateText($text, $maxLength = 120)
{
    if (strlen($text) > $maxLength) {
        $truncatedText = substr($text, 0, $maxLength - 3) . '...';
        return $truncatedText;
    }
    return $text;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-liquide</title>
    <link rel="stylesheet" href="http://127.0.0.1/em/style_main.css" />
    <style>
        .favorite-heart {
            cursor: pointer;
            font-size: 36px;
            color: grey;
            position: absolute;
            top: 10px;
            right: 10px;
            transition: color 3s;
        }

        .favorite-heart.favorited {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="http://127.0.0.1/em/"><img src="http://127.0.0.1/em/logo.png" alt="" /></a>
        </div>

        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav class="menu">
            <ul>
                <li>
                    <input class="searchbar" type="search" placeholder="rechercher" required id="search" value=""
                        onchange="ouvrirpages()" />
                </li>
                <li><a href="http://127.0.0.1/em/">accueil</a></li>
                <li><a href="http://127.0.0.1/em/pages/menu-e-liquide.php">menu e-liquide</a></li>
                <li><a href="http://127.0.0.1/em/pages/eliquide.php">e-liquide</a></li>
                <li><a href="http://127.0.0.1/em/pages/CE.php">cigarette électronique</a></li>
                <li><a href="http://127.0.0.1/em/pages/panier.php">panier</a></li>
                <li><a href="http://127.0.0.1/em/pages/nous-contacter.php">contact</a></li>
            </ul>
        </nav>

        <h1>eliquide</h1>
    </header>

    <?php $products = $DB->query('SELECT * FROM products WHERE categorie = "eliquide"'); ?>

    <?php $pdo = new PDO('mysql:host=localhost;dbname=dbs12515927', 'root', '');
    $query = $pdo->prepare('SELECT product_name FROM favorites WHERE user_id = :user_id');
    $query->execute(['user_id' => $user_id]);
    $favs = $query->fetchAll(PDO::FETCH_OBJ); ?>

    <div class="img-ce">
        <?php foreach ($products as $product): ?>
            <div class="overlay">
                <?php $isfav = false; ?>
                <?php
                foreach ($favs as $fav) {
                    if ($fav->product_name == $product->name) {
                        echo '<span class="favorite-heart fav" onclick="AddFav(<?= $product->id ?>)" data-product-id="<?= $product->id ?>">&#x2661;</span>';
                        $isfav = true;
                    }

                }
                if (!$isfav) {
                    echo '<span class="favorite-heart unfav" onclick="RemoveFav(<?= $product->id ?>)" data-product-id="<?= $product->id ?>">&#x2661;</span>';
                }

                ?>


                <h3><?= $product->name ?></h3>
                <p><?= truncateText($product->description) ?></p>
                <a href="http://127.0.0.1/em/pages/eliquide/eliquide-pages.php?id=<?= $product->id ?>">
                    <img src="<?= $product->url_photo ?>" alt="Image" class="img" />
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include '../footer.php'; ?>

    <script>
        function AddFav(prod_id) {
            const productElement = document.querySelector(`[data-product-id='${prod_id}']`);
            productElement.textContent = 'caca';
            productElement.classList.add('fav');
            productElement.classList.remove('unfav');
            productElement.setAttribute("onclick")
        }

        function RemoveFav(prod_id) {
            const productElement = document.querySelector(`[data-product-id='${prod_id}']`);
            productElement.textContent = 'caca';
            productElement.classList.add('unfav');
            productElement.classList.remove('fav');
        }



        document.addEventListener("DOMContentLoaded", function () {
            const favoriteHearts = document.querySelectorAll('.favorite-heart');
            favoriteHearts.forEach(heart => {
                const productId = heart.parentElement.getAttribute('data-product-id');
                if (isFavorite(productId)) {
                    heart.classList.add('favorited');
                    heart.textContent = '❤️';
                }
            });
        });

        function toggleFavorite(productId) {
            if (isFavorite(productId)) {
                removeFavorite(productId);
            } else {
                addFavorite(productId);
            }
            updateFavoriteHeart(productId);
        }

        function isFavorite(productId) {
            const favorites = getFavorites();
            return favorites.includes(productId.toString());
        }

        function addFavorite(productId) {
            let favorites = getFavorites();

            // Vérifiez si le produit est déjà dans les favoris
            if (!favorites.includes(productId)) {
                favorites.push(productId);
                localStorage.setItem('favorites', JSON.stringify(favorites));
                updateFavoriteInDatabase(productId, 'add');
            }
        }

        function removeFavorite(productId) {
            let favorites = getFavorites();
            favorites = favorites.filter(id => id != productId.toString());
            localStorage.setItem('favorites', JSON.stringify(favorites));
            updateFavoriteInDatabase(productId, 'remove');
        }

        function getFavorites() {
            return JSON.parse(localStorage.getItem('favorites')) || [];
        }

        function updateFavoriteHeart(productId) {
            const productElement = document.querySelector(`[data-product-id='${productId}']`);
            const heart = productElement.querySelector('.favorite-heart');
            if (isFavorite(productId)) {
                heart.classList.add('favorited');
                heart.textContent = '❤️';
            } else {
                heart.classList.remove('favorited');
                heart.textContent = '♡';
            }
        }

        function updateFavoriteInDatabase(productId, action) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_favorite.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        updateFavoriteHeart(productId);
                    } else {
                        console.error('Error updating favorite:', xhr.responseText);
                    }
                }
            };

            const productName = document.querySelector(`[data-product-id='${productId}'] h3`).textContent;

            const productImage = document.querySelector(`[data-product-id='${productId}'] img`).getAttribute('src');

            xhr.send(`product_id=${productId}&action=${action}&product_name=${encodeURIComponent(productName)}&product_image=${encodeURIComponent(productImage)}`);
        }
    </script>
</body>
<script src="http://127.0.0.1/em/script.js"></script>

</html>