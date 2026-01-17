-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 17 jan. 2026 à 09:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs12515927`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `pays` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id`, `user_id`, `adresse`, `ville`, `code_postal`, `pays`) VALUES
(34, 13, '4 allée des sablons', 'LOUVECIENNES', '78430', 'France'),
(41, 10, '6 rue henri de gondi', 'bailly', '78870', 'France'),
(66, 18, '24 rue caruel de saint-martin ', 'le Chesnay ', '78150', 'France'),
(69, 13, '4 allée des sablons', 'LOUVECIENNES', '78430', 'France'),
(71, 30, '40 ALLÉE DU BUTARD', 'VAUCRESSON', '92420', 'France'),
(85, 13, '4 Allée des Sablons', 'Louveciennes', '78430', 'France'),
(86, 13, '4 Allée des Sablons', 'Louveciennes', '78430', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `numero_commande` varchar(50) NOT NULL,
  `date_commande` timestamp NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `produits` varchar(255) NOT NULL,
  `mode_paiement` int(11) NOT NULL,
  `adresses` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `numero_commande`, `date_commande`, `total`, `statut`, `produits`, `mode_paiement`, `adresses`) VALUES
(1, 13, '039478023840238408', '2024-02-04 18:16:19', 9.99, 'en cours de traitement', '0', 0, ''),
(2, 18, '56l6693j556f99', '2024-02-05 18:16:19', 45.99, 'en cours de traitement', '0', 0, ''),
(28, 30, '0256589454045789', '2024-02-06 18:45:06', 9.99, 'en cours de traitement', '0', 0, ''),
(50, 10, '6617e922a99f9', '2024-04-11 13:44:02', 57.98, 'en cours de traitement', 'menu classique, seven sins, luxe q', 0, ''),
(82, 10, '66196b975a112', '2024-04-12 17:12:55', 35.99, 'en cours de traitement', 'drag x', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `espace_membre`
--

CREATE TABLE `espace_membre` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `pts_fidelite` smallint(6) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `espace_membre`
--

INSERT INTO `espace_membre` (`id`, `pseudo`, `mail`, `motdepasse`, `pts_fidelite`, `Nom`, `Prénom`) VALUES
(10, 'baptiste.molko', 'baptiste.molko@eliquide-menu.fr', '$2y$10$jnlmuKgCDWGerH27WdV9reGB0jba2ibUNNkaQQKATOyAXEkaA/5k2', 0, 'Molko', 'Baptiste'),
(13, 'Skentzel5 ', 'swannkentzel5@gmail.com', '$2y$10$Z6zXMMOyIQytnpxuHQEuf.0csgKYUGCLDKuYe1KWpHPmjXck3Gaci', 0, 'Kentzel', 'Swann'),
(17, 'Huguette', 'hugo.chatellain@gmail.com', '$2y$10$.xFfJyyFbKvonL/DMLtU.O0Hao8dAdpz1Wk4q4IF1iqXNt2RnhY9K', 0, 'Chatellain', 'Hugo'),
(18, 'la_meche78150', 'dezourayan5@outlook.fr', '$2y$10$FVmjWAwPlHRQHnZNrgGi4e8zzcgArcdzwonqsCrrlDRJ5b1zYjYbe', 0, 'Dezou', 'Rayan'),
(30, 'sniper2000', 'anton.feuga@gmail.com', '$2y$10$uGnGGo7Wdasrzd1RzoRpke8huUr9TgWjpzjPFD0o8cL/ttCEUIUxq', 0, 'Feuga', 'Anton'),
(37, 'bat', 'baba78450molko@gmail.com', '$2y$10$aBnY2N3HsLtyhExJwR1LVuZL2xSyydI396zsa.sxmggqjHnyLwzqW', 0, 'Molko', 'Baptiste'),
(38, 'Baptiste molko', 'direction.globaltradings@gmail.com', '$2y$10$qN2I/lker3.3z.NxndwZTuJH1mcvxFx6Tb1ugIGY.F7rspB7VfvSq', 0, 'molko', 'Baptiste');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `product_name`, `product_image`) VALUES
(58, 13, 7, '2024-09-12 13:46:53', 'seven sins', 'http://eliquide-menu.fr/pages/img-eliquide/seven-sins-50ml.jpg'),
(59, 13, 8, '2024-09-12 13:46:54', 'ragnarok', 'http://eliquide-menu.fr/pages/img-eliquide/ragnarok-50ml.jpg'),
(82, 10, 10, '2024-10-20 20:56:48', 'secret mango', 'http://eliquide-menu.fr/pages/img-eliquide/secret-mango-50ml.jpg'),
(83, 10, 25, '2024-10-20 20:56:53', 'bloody summer', 'http://eliquide-menu.fr/pages/img-eliquide/bloody-summer-50ml.jpg'),
(84, 10, 27, '2024-10-20 20:57:05', 'blue devil', 'http://eliquide-menu.fr/pages/img-eliquide/blue-devil-50ml.jpg'),
(85, 10, 26, '2024-10-20 20:57:09', 'heisenberg', 'http://eliquide-menu.fr/pages/img-eliquide/heisenberg-50ml.jpg'),
(87, 10, 7, '2024-10-28 16:06:27', 'seven sins', 'http://eliquide-menu.fr/pages/img-eliquide/seven-sins-50ml.jpg'),
(88, 10, 6, '2024-10-28 16:06:29', 'red pearl', 'http://eliquide-menu.fr/pages/img-eliquide/red-pearl-50ml.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `espace_membre`
--
ALTER TABLE `espace_membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `espace_membre`
--
ALTER TABLE `espace_membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `espace_membre` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `espace_membre` (`id`);

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `espace_membre` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
