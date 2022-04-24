-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 24 avr. 2022 à 14:59
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `siteweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `animes`
--

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `synopsis` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `note` decimal(3,2) NOT NULL DEFAULT -1.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animes`
--

INSERT INTO `animes` (`id`, `synopsis`, `video`, `image`, `titre`, `note`) VALUES
(1, 'Dans un monde ravagé par des titans mangeurs d\'homme depuis plus d\'un siècle, les rares survivants de l\'Humanité n\'ont d\'autre choix pour survivre que de se barricader dans une cité-forteresse.', 'https://www.youtube.com/watch?v=MGRm4IzK1SQ', 'Shingeki-no-Kyojin-FInal-Season-image-scaled.jpg', 'SNK', '4.00'),
(2, 'Le groupe de Tanjirô a terminé son entraînement de récupération au domaine des papillons et embarque à présent en vue de sa prochaine mission à bord du train de l\'infini, d\'où quarante personnes ont disparu en peu de temps. Tanjirô et Nezuko, accompagnés de Zen\'itsu et Inosuke, s\'allient à l\'un des plus puissants épéistes de l\'armée des pourfendeurs de démons, le Pilier de la Flamme Kyôjurô Rengoku, afin de contrer le démon qui a engagé le train de l\'Infini sur une voie funeste.', '', '', 'Demon Slayer', '2.50');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `user_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `avis` text NOT NULL,
  `note` tinyint(4) NOT NULL,
  `commentaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`user_id`, `anime_id`, `avis`, `note`, `commentaire_id`) VALUES
(11, 1, 'Trop cool', 5, 9),
(11, 2, 'J&#039;aime trop', 3, 10),
(11, 2, 'Cool', 3, 13),
(11, 1, 'Sympa !!!', 5, 14),
(8, 1, 'J&#039;aime bien', 3, 15),
(7, 1, 'Salut', 3, 18),
(7, 2, 'test', 0, 19),
(7, 2, 'Trop cool', 4, 20);

-- --------------------------------------------------------

--
-- Structure de la table `mangas`
--

CREATE TABLE `mangas` (
  `id` int(11) NOT NULL,
  `synopsis` text NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `signalements`
--

CREATE TABLE `signalements` (
  `user_id` int(11) NOT NULL,
  `commentaire_id` int(11) NOT NULL,
  `motif` text NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `signalements`
--

INSERT INTO `signalements` (`user_id`, `commentaire_id`, `motif`, `commentaire`) VALUES
(11, 9, 'Autre', 'Trop cool'),
(8, 15, 'Commentaire à but commercial', 'J&#039;aime bien');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `pseudo`, `password`, `admin`) VALUES
(7, 'ffff@gmail.com', 'bob12', '$2y$12$sMTSwXuLhVUAQ7eZPc00CeXutxE/1oa4I5LtxBE0V0RqEzjp.D.gW', 0),
(8, 'test@gmail.com', 'test34', '$2y$12$p6gDTkll/vkG3dG52KNFR.C9GFl/CVpBLKQAlh9IRleIv38wd3lYq', 0),
(11, 'azertyy.bob@gmail.com', 'bob65', '$2y$12$2XJIb15/z44PePyBWCSHrOv4kqVNXuB7nZ571idMdRvYcRcflNwcm', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`commentaire_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Index pour la table `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signalements`
--
ALTER TABLE `signalements`
  ADD UNIQUE KEY `commentaire_id` (`commentaire_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `commentaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`anime_id`) REFERENCES `animes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signalements`
--
ALTER TABLE `signalements`
  ADD CONSTRAINT `signalements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `signalements_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`commentaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
