-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 mai 2024 à 19:04
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `socialnetwork`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` date DEFAULT curdate(),
  `hour` time DEFAULT curtime(),
  `image` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `id_post`, `id_user`, `content`, `date`, `hour`, `image`) VALUES
(1, 58, 40, 'Alors là bête de post mon frere', '2024-05-05', '11:37:34', NULL),
(2, 58, 45, 'azdaz', '2024-05-05', '18:39:00', NULL),
(3, 58, 45, 'test', '2024-05-05', '18:39:44', '3.jpg'),
(4, 58, 45, 'test', '2024-05-05', '18:41:47', NULL),
(5, 58, 45, 'dzadazd', '2024-05-05', '18:49:09', NULL),
(6, 58, 45, 'zdazdzd', '2024-05-05', '18:49:27', NULL),
(7, 58, 45, 'Je suis content que tu sois OKKKK', '2024-05-05', '18:50:05', '7.png'),
(8, 58, 45, 'Dernier Test', '2024-05-05', '18:52:11', NULL),
(9, 58, 45, 'dernier test', '2024-05-05', '18:52:50', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id`, `id_user`, `id_follow`) VALUES
(20, 48, 45),
(34, 52, 45),
(35, 51, 45),
(42, 45, 40),
(43, 45, 51),
(44, 45, 48),
(45, 53, 45),
(46, 54, 45),
(47, 55, 45),
(48, 56, 45),
(49, 57, 45),
(50, 45, 53),
(51, 45, 57);

-- --------------------------------------------------------

--
-- Structure de la table `likedcomment`
--

CREATE TABLE `likedcomment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likedpost`
--

CREATE TABLE `likedpost` (
  `id` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likedpost`
--

INSERT INTO `likedpost` (`id`, `id_post`, `id_user`) VALUES
(52, 46, 40),
(53, 51, 40),
(54, 48, 40),
(56, 51, 51),
(57, 51, 57);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `viewed` int(11) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `hour` time DEFAULT current_timestamp(),
  `retirer` tinyint(4) DEFAULT NULL,
  `id_like` int(11) DEFAULT NULL,
  `warning` int(11) DEFAULT NULL,
  `id_comment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `id_post`, `content`, `viewed`, `date`, `hour`, `retirer`, `id_like`, `warning`, `id_comment`) VALUES
(1, 45, 51, 'Mek tu fais quoi', 1, '2024-05-02', '10:57:48', 1, NULL, 1, NULL),
(2, 48, 48, 'Your post may cause several problems regarding our rules', 1, '2024-05-03', '09:24:39', 1, NULL, 1, NULL),
(3, 45, 51, 'Your post may cause several problems regarding our rules', 1, '2024-05-04', '11:02:43', 1, NULL, 1, NULL),
(24, 45, 46, 'liked your post', 0, '2024-05-04', '14:59:13', 0, 52, 0, NULL),
(25, 45, 47, 'Your post may cause several problems regarding our rules', 1, '2024-05-04', '14:59:16', 0, NULL, 1, NULL),
(26, 48, 48, 'Your post may cause several problems regarding our rules', 0, '2024-05-04', '20:44:39', 0, NULL, 1, NULL),
(27, 45, 51, 'liked your post', 0, '2024-05-04', '21:04:39', 0, 53, 0, NULL),
(28, 48, 48, 'liked your post', 0, '2024-05-04', '21:04:43', 0, 54, 0, NULL),
(29, 45, 51, 'liked your post', 0, '2024-05-05', '16:28:11', 0, 56, 0, NULL),
(30, 45, 51, 'liked your post', 0, '2024-05-05', '16:45:22', 0, 57, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` varchar(128) NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `retirer` tinyint(1) DEFAULT NULL,
  `flou` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `id_user`, `time`, `content`, `image`, `retirer`, `flou`) VALUES
(46, 45, '2024-04-20 09:43:47', 'Bonjour', '46.png', NULL, NULL),
(47, 45, '2024-04-20 09:46:34', 'alors là vraiment', '47.png', NULL, 1),
(48, 48, '2024-04-20 10:24:31', 'Wow nouveau post', '48.jpg', NULL, 1),
(49, 40, '2024-04-21 12:46:56', 'Je suis l\'administrateur de ce réseau social', '49.jpeg', NULL, NULL),
(51, 45, '2024-04-21 13:15:10', 'Je test ', NULL, NULL, NULL),
(52, 40, '2024-04-28 11:43:09', 'test', NULL, NULL, NULL),
(53, 40, '2024-04-29 13:22:59', 'test', NULL, NULL, NULL),
(54, 40, '2024-04-29 13:23:01', 'test', NULL, NULL, NULL),
(55, 40, '2024-04-29 13:23:06', 'test33', NULL, NULL, NULL),
(56, 40, '2024-05-01 17:21:06', 'test\r\n', NULL, NULL, NULL),
(57, 40, '2024-05-01 17:21:11', 'testasazdazd\r\n', NULL, NULL, NULL),
(58, 40, '2024-05-01 17:21:15', 'okkkk', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `birthday` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `profile_picture` varchar(128) DEFAULT NULL,
  `ban` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `age`, `birthday`, `email`, `password`, `pseudo`, `admin`, `profile_picture`, `ban`) VALUES
(40, 'admin', 'admin', 24, 2000, 'admin@tzu.com', '$argon2id$v=19$m=65536,t=4,p=1$Uy5hQWJNUE5ZUnN6eDRMbg$I7y5+vPal6trTjdEnQroJ4lP8rwVgmz0YdcQk4djdv4', 'admin', 1, 'admin.jpeg', 0),
(45, 'Matteo', 'Chaouche', 24, 2000, 'glenmorton5555@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YkZVOTFxZFpLRnZGUExsQg$zIyP5EJ3ay5dITaPAiwEvM/4jOsnspjeAv48eqCcdgk', 'GlenMorton', NULL, '45.JPG', 0),
(48, 'Thomas', 'Gredin', 28, 1996, 'tom.gredin@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$cUxPRHY5MmcwT3pjNHAyUg$3DrPD8V7UBAtGFgFWM9Pgqc8xyf/2p3JE6sTI2km5/s', 'stagram', NULL, '#92FDCE', 0),
(50, 'Léonie', 'Bertrand', 26, 1998, 'leoni.bertrand@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$cGgxVUxnTVczaWhCOHR2OQ$AroC9hlevwsZS61wYAeZb3vEesc8Vxqi9VXzUHUosr8', 'lolo', NULL, '#E826EC', 0),
(51, 'Jean', 'Valjean', 24, 2000, 'jean.valjean@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$REFlbmFORFhWMGZQLm1WSQ$mujiHkqfu8hEiP6g7Zo+19dcRPpLtr7rAuR8MEyzo5o', 'JeanValjean', NULL, '#531DA3', 0),
(52, 'Michel', 'Rost', 23, 2001, 'michel.rost@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$Ujc5Ti5lNmdmR0tTRWhORA$ZbVacQaFTGeWijU0hCgwauBsO3Zn0Rf2BYtS+pbVbLY', 'Miche', NULL, '#24A1DA', 0),
(53, 'Valentine', 'Cru', 21, 2003, 'valentine.cru@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MllOS0ZEbHp4N2pITzJSdA$rWOtc242mdK1wmIM7ks84Yvb19k2maq3PS1gpCMdtqY', 'vava', NULL, '#5FD1B8', 0),
(54, 'Robin', 'Moirot', 22, 2002, 'robin.moirot@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$SThxbVJkczh4a2ZLRlhIcQ$9SWtPa/WLFtR/Q5hBUwhiK4Arvo/FW3/N10FiwIIUlo', 'RORO', NULL, '#DF9395', 0),
(55, 'Hugo', 'Decrypte', 42, 1982, 'hugo.decrypte@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MXEudzVnRFcud2E1UjJmdA$pVBZ+V85L2wGtUvip03fFp87huSPvDD2nVXvnbgONNU', 'hugBig', NULL, '#E4376B', 0),
(56, 'Stephane', 'Jore', 35, 1989, 'stephane.jore@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MTB6QTd2QWJtOFN4Q1lPRQ$bNp6DZIUXFTNr1svv+s9gXMQSEo9qr8qb3ZBzffZPU4', 'steph', NULL, '#D20D65', 0),
(57, 'Camille', 'Moiset', 20, 2004, 'camille.moiset@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$RFdsRDNDbGZ6TDd3Y001aA$BL0/z5omHFIZaay6oYDvXyQ9iAYbjTab7sGpURvkNnU', 'camcam', NULL, '#5947C4', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_follow` (`id_follow`);

--
-- Index pour la table `likedcomment`
--
ALTER TABLE `likedcomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comment` (`id_comment`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `likedpost`
--
ALTER TABLE `likedpost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post` (`id_post`),
  ADD KEY `idx_user` (`id_user`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `idx_like` (`id_like`),
  ADD KEY `idx_comment` (`id_comment`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `idx_flou` (`flou`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `likedcomment`
--
ALTER TABLE `likedcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likedpost`
--
ALTER TABLE `likedpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_follow`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likedcomment`
--
ALTER TABLE `likedcomment`
  ADD CONSTRAINT `likedcomment_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedcomment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likedpost`
--
ALTER TABLE `likedpost`
  ADD CONSTRAINT `likedpost_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedpost_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`id_like`) REFERENCES `likedpost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
