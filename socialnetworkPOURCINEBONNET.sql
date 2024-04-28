-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 avr. 2024 à 12:53
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
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 40, 45),
(20, 48, 45),
(28, 45, 48);

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
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likedpost`
--

INSERT INTO `likedpost` (`id_post`, `id_user`) VALUES
(46, 40),
(46, 45),
(47, 40),
(47, 48),
(48, 40),
(48, 45),
(49, 40),
(50, 45),
(51, 40),
(51, 45);

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
  `hour` time DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `id_post`, `content`, `viewed`, `date`, `hour`) VALUES
(1, 48, 48, 'Your post may causes several problem regarding our rules ', NULL, '2024-04-25', '21:47:14'),
(2, 40, 49, 'test', NULL, '2024-04-25', '21:47:14'),
(3, 45, 46, 'Your post may causes several problem regarding our rules ', 0, '2024-04-25', '21:47:14'),
(4, 45, 51, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:07:17'),
(5, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:07:23'),
(6, 45, 46, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:10:55'),
(7, 45, 47, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:11:03'),
(8, 48, 48, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:14:12'),
(9, 45, 51, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:16:36'),
(10, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:17:10'),
(11, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:20:06'),
(12, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:20:09'),
(13, 45, 51, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:21:39'),
(14, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:22:30'),
(15, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:24:02'),
(16, 45, 47, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:26:17'),
(17, 45, 46, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:27:06'),
(18, 48, 48, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:29:13'),
(19, 45, 46, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:31:56'),
(20, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-27', '20:32:09'),
(21, 45, 51, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:17:33'),
(22, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:21:48'),
(23, 48, 48, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:25:54'),
(24, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:27:45'),
(25, 45, 47, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:42:57'),
(26, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:43:17'),
(27, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:45:13'),
(28, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:49:15'),
(29, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '11:54:00'),
(30, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:04:33'),
(31, 45, 51, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:08:18'),
(32, 45, 47, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:16:54'),
(33, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:21:37'),
(34, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:31:05'),
(35, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:31:17'),
(36, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:31:21'),
(37, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:31:24'),
(38, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:35:10'),
(39, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:35:18'),
(40, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:35:22'),
(41, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:38:36'),
(42, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:38:40'),
(43, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:38:44'),
(44, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:41:51'),
(45, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:41:55'),
(46, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:43:06'),
(47, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:43:10'),
(48, 40, 52, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:46:42'),
(49, 40, 50, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:47:45'),
(50, 40, 49, 'Your post may causes several problem regarding our rules ', 0, '2024-04-28', '12:48:45');

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
(47, 45, '2024-04-20 09:46:34', 'alors là vraiment', '47.png', NULL, NULL),
(48, 48, '2024-04-20 10:24:31', 'Wow nouveau post', '48.jpg', NULL, NULL),
(49, 40, '2024-04-21 12:46:56', 'Je suis l\'administrateur de ce réseau social', '49.jpeg', NULL, 1),
(50, 40, '2024-04-21 13:14:32', 'Bonjour l\'administrateur du réseau prévient d\'une mise à jour importante', '50.png', NULL, 1),
(51, 45, '2024-04-21 13:15:10', 'Je test ', NULL, NULL, NULL),
(52, 40, '2024-04-28 11:43:09', 'test', NULL, NULL, 1);

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
(45, 'Matteo', 'Chaouche', 24, 2000, 'glenmorton5555@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YkZVOTFxZFpLRnZGUExsQg$zIyP5EJ3ay5dITaPAiwEvM/4jOsnspjeAv48eqCcdgk', 'Glen', NULL, '45.JPG', 0),
(48, 'Thomas', 'Gredin', 28, 1996, 'tom.gredin@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$cUxPRHY5MmcwT3pjNHAyUg$3DrPD8V7UBAtGFgFWM9Pgqc8xyf/2p3JE6sTI2km5/s', 'stagram', NULL, '#92FDCE', 0);

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
  ADD PRIMARY KEY (`id_post`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `likedcomment`
--
ALTER TABLE `likedcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  ADD CONSTRAINT `likedpost_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedpost_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
