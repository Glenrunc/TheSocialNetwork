-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 mai 2024 à 22:02
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
-- Structure de la table `ban`
--

CREATE TABLE `ban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_begin` date DEFAULT curdate(),
  `date_end` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 58, 45, 'dernier test', '2024-05-05', '18:52:50', NULL),
(11, 48, 40, 'Quelle photo c\'est super beau ', '2024-05-06', '08:35:08', NULL),
(12, 58, 40, 'c\'est frais man', '2024-05-06', '11:34:17', NULL),
(13, 58, 40, 'mec c\'est cool', '2024-05-06', '11:37:33', NULL),
(14, 58, 40, '', '2024-05-06', '11:37:47', '14.JPG'),
(15, 48, 45, 'Salut jeune entrepreneur', '2024-05-06', '11:56:43', '15.JPG'),
(16, 62, 45, 'J\'aime bien ! ', '2024-05-06', '13:38:41', NULL),
(17, 61, 45, 'Top beau wow', '2024-05-06', '13:49:23', NULL),
(18, 47, 45, 'tu vas un peu loin là !', '2024-05-06', '14:21:44', NULL),
(19, 59, 40, 'Test notif comment', '2024-05-06', '14:53:43', NULL),
(20, 64, 40, 'OUAIIIII', '2024-05-06', '14:55:44', NULL),
(21, 64, 48, 'Superrrr', '2024-05-06', '14:56:09', NULL),
(22, 63, 48, 'Je confirme ça marche biennnnnnnng', '2024-05-06', '14:56:42', NULL),
(23, 51, 40, 'Test bien ouai ouai', '2024-05-06', '15:00:34', NULL),
(24, 51, 48, 'Test encore mon gars ', '2024-05-06', '15:01:13', NULL),
(25, 83, 45, 'Trop beau les rues d\'Italie', '2024-05-06', '20:38:35', NULL),
(26, 83, 40, 'Merci @MorduDu7°', '2024-05-06', '20:43:54', NULL),
(27, 65, 40, 'génial', '2024-05-07', '12:43:12', NULL),
(28, 65, 56, 'Merci Admin', '2024-05-07', '20:59:54', '28.JPG');

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
(43, 45, 51),
(45, 53, 45),
(46, 54, 45),
(47, 55, 45),
(48, 56, 45),
(49, 57, 45),
(50, 45, 53),
(52, 40, 57),
(54, 40, 45),
(59, 45, 40),
(60, 45, 48),
(61, 45, 55),
(62, 45, 57),
(63, 45, 52),
(66, 56, 57),
(67, 56, 40),
(68, 48, 40),
(69, 40, 56),
(70, 57, 40);

-- --------------------------------------------------------

--
-- Structure de la table `likedcomment`
--

CREATE TABLE `likedcomment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likedcomment`
--

INSERT INTO `likedcomment` (`id`, `id_comment`, `id_user`) VALUES
(82, 25, 40),
(84, 26, 40),
(103, 26, 45),
(104, 25, 45),
(105, 12, 45),
(106, 13, 45),
(107, 1, 45),
(109, 27, 40),
(114, 27, 45),
(115, 17, 45);

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
(56, 51, 51),
(57, 51, 57),
(71, 48, 40),
(77, 61, 48),
(78, 62, 45),
(80, 51, 45),
(81, 65, 56),
(82, 65, 57),
(83, 64, 57),
(84, 63, 57),
(85, 62, 57),
(86, 49, 57),
(87, 52, 57),
(88, 53, 57),
(89, 54, 57),
(90, 55, 57),
(91, 56, 57),
(92, 57, 57),
(93, 58, 57),
(97, 84, 40),
(98, 47, 40),
(100, 66, 40),
(102, 56, 40),
(108, 51, 40);

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
  `id_comment` int(11) DEFAULT NULL,
  `id_follow` int(11) DEFAULT NULL,
  `id_like_comment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `id_post`, `content`, `viewed`, `date`, `hour`, `retirer`, `id_like`, `warning`, `id_comment`, `id_follow`, `id_like_comment`) VALUES
(1, 45, 51, 'Mek tu fais quoi', 1, '2024-05-02', '10:57:48', 1, NULL, 1, NULL, NULL, NULL),
(2, 48, 48, 'Your post may cause several problems regarding our rules', 1, '2024-05-03', '09:24:39', 1, NULL, 1, NULL, NULL, NULL),
(3, 45, 51, 'Your post may cause several problems regarding our rules', 1, '2024-05-04', '11:02:43', 1, NULL, 1, NULL, NULL, NULL),
(24, 45, 46, 'liked your post', 0, '2024-05-04', '14:59:13', 0, 52, 0, NULL, NULL, NULL),
(25, 45, 47, 'Your post may cause several problems regarding our rules', 0, '2024-05-04', '14:59:16', 0, NULL, 1, NULL, NULL, NULL),
(26, 48, 48, 'Your post may cause several problems regarding our rules', 0, '2024-05-04', '20:44:39', 0, NULL, 1, NULL, NULL, NULL),
(29, 45, 51, 'liked your post', 0, '2024-05-05', '16:28:11', 0, 56, 0, NULL, NULL, NULL),
(30, 45, 51, 'liked your post', 0, '2024-05-05', '16:45:22', 0, 57, 0, NULL, NULL, NULL),
(37, 48, 48, 'liked your', 0, '2024-05-06', '08:58:58', 0, 71, 0, NULL, NULL, NULL),
(41, 45, 59, 'Your post may cause several problems regarding our rules', 1, '2024-05-06', '10:59:13', 1, NULL, 1, NULL, NULL, NULL),
(42, 48, 62, 'liked your', 0, '2024-05-06', '13:38:32', 0, 78, 0, NULL, NULL, NULL),
(44, 45, 59, 'add a comment on your', 0, '2024-05-06', '14:53:43', 0, NULL, 0, 19, NULL, NULL),
(45, 48, 64, 'add a comment on your', 0, '2024-05-06', '14:55:44', 0, NULL, 0, 20, NULL, NULL),
(46, 40, 63, 'add a comment on your', 1, '2024-05-06', '14:56:42', 0, NULL, 0, 22, NULL, NULL),
(47, 45, 51, 'add a comment on your', 0, '2024-05-06', '15:00:34', 0, NULL, 0, 23, NULL, NULL),
(48, 45, 51, 'add a comment on your', 0, '2024-05-06', '15:01:13', 0, NULL, 0, 24, NULL, NULL),
(50, 57, NULL, 'started following you', 0, '2024-05-06', '15:33:09', 0, NULL, 0, NULL, 66, NULL),
(51, 40, NULL, 'started following you', 0, '2024-05-06', '15:36:23', 0, NULL, 0, NULL, 67, NULL),
(52, 56, 65, 'liked your', 0, '2024-05-06', '15:38:26', 0, 82, 0, NULL, NULL, NULL),
(53, 48, 64, 'liked your', 0, '2024-05-06', '15:38:27', 0, 83, 0, NULL, NULL, NULL),
(54, 40, 63, 'liked your', 0, '2024-05-06', '15:38:28', 0, 84, 0, NULL, NULL, NULL),
(55, 48, 62, 'liked your', 0, '2024-05-06', '15:38:30', 0, 85, 0, NULL, NULL, NULL),
(56, 40, 49, 'liked your', 0, '2024-05-06', '15:38:44', 0, 86, 0, NULL, NULL, NULL),
(57, 40, 52, 'liked your', 0, '2024-05-06', '15:38:46', 0, 87, 0, NULL, NULL, NULL),
(58, 40, 53, 'liked your', 0, '2024-05-06', '15:38:46', 0, 88, 0, NULL, NULL, NULL),
(59, 40, 54, 'liked your', 0, '2024-05-06', '15:38:47', 0, 89, 0, NULL, NULL, NULL),
(60, 40, 55, 'liked your', 0, '2024-05-06', '15:38:48', 0, 90, 0, NULL, NULL, NULL),
(61, 40, 56, 'liked your', 0, '2024-05-06', '15:38:49', 0, 91, 0, NULL, NULL, NULL),
(62, 40, 57, 'liked your', 0, '2024-05-06', '15:38:49', 0, 92, 0, NULL, NULL, NULL),
(63, 40, 58, 'liked your', 0, '2024-05-06', '15:38:50', 0, 93, 0, NULL, NULL, NULL),
(64, 40, NULL, 'started following you', 0, '2024-05-06', '15:51:43', 0, NULL, 0, NULL, 68, NULL),
(65, 56, NULL, 'started following you', 0, '2024-05-06', '16:04:27', 0, NULL, 0, NULL, 69, NULL),
(112, 45, 83, 'add a new', 0, '2024-05-06', '20:30:47', 0, NULL, 0, NULL, NULL, NULL),
(113, 56, 83, 'add a new', 0, '2024-05-06', '20:30:47', 0, NULL, 0, NULL, NULL, NULL),
(114, 48, 83, 'add a new', 0, '2024-05-06', '20:30:47', 0, NULL, 0, NULL, NULL, NULL),
(115, 40, 83, 'add a comment on your', 0, '2024-05-06', '20:38:35', 0, NULL, 0, 25, NULL, NULL),
(117, 48, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(118, 52, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(119, 51, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(120, 53, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(121, 54, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(122, 55, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(123, 56, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(124, 57, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(125, 40, 84, 'add a new', 0, '2024-05-06', '20:39:06', 0, NULL, 0, NULL, NULL, NULL),
(126, 45, 84, 'liked your', 0, '2024-05-06', '20:45:43', 0, 97, 0, NULL, NULL, NULL),
(127, 45, 47, 'liked your', 0, '2024-05-07', '10:27:32', 0, 98, 0, NULL, NULL, NULL),
(134, 40, 83, 'liked your', 0, '2024-05-07', '12:40:43', 0, NULL, 0, NULL, NULL, 103),
(135, 40, 58, 'liked your', 0, '2024-05-07', '12:42:06', 0, NULL, 0, NULL, NULL, 105),
(136, 40, 58, 'liked your', 0, '2024-05-07', '12:42:07', 0, NULL, 0, NULL, NULL, 106),
(137, 40, 58, 'liked your', 0, '2024-05-07', '12:42:09', 0, NULL, 0, NULL, NULL, 107),
(138, 56, 65, 'add a comment on your', 0, '2024-05-07', '12:43:12', 0, NULL, 0, 27, NULL, NULL),
(140, 57, 66, 'liked your', 0, '2024-05-07', '12:59:50', 0, 100, 0, NULL, NULL, NULL),
(145, 40, 65, 'liked your', 0, '2024-05-07', '20:45:42', 0, NULL, 0, NULL, NULL, 114),
(146, 56, 65, 'Your post may cause several problems regarding our rules', 0, '2024-05-07', '20:47:59', 0, NULL, 1, NULL, NULL, NULL),
(148, 45, 47, 'Your post may cause several problems regarding our rules', 0, '2024-05-07', '21:01:15', 0, NULL, 1, NULL, NULL, NULL),
(154, 45, 51, 'liked your', 0, '2024-05-07', '21:05:17', 0, 108, 0, NULL, NULL, NULL),
(155, 57, NULL, 'Your comportement is problematic be aware that you could be ban from the website!', 0, '2024-05-07', '21:50:23', 0, NULL, 1, NULL, NULL, NULL),
(156, 40, NULL, 'started following you', 0, '2024-05-07', '21:54:00', 0, NULL, 0, NULL, 70, NULL);

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
(48, 48, '2024-04-20 10:24:31', 'Wow nouveau post', '48.jpg', NULL, NULL),
(49, 40, '2024-04-21 12:46:56', 'Je suis l\'administrateur de ce réseau social', '49.jpeg', NULL, NULL),
(51, 45, '2024-04-21 13:15:10', 'Je test ', NULL, NULL, NULL),
(52, 40, '2024-04-28 11:43:09', 'test', NULL, NULL, NULL),
(53, 40, '2024-04-29 13:22:59', 'test', NULL, NULL, NULL),
(54, 40, '2024-04-29 13:23:01', 'test', NULL, NULL, NULL),
(55, 40, '2024-04-29 13:23:06', 'test33', NULL, NULL, NULL),
(56, 40, '2024-05-01 17:21:06', 'test\r\n', NULL, NULL, NULL),
(57, 40, '2024-05-01 17:21:11', 'testasazdazd\r\n', NULL, NULL, NULL),
(58, 40, '2024-05-01 17:21:15', 'okkkk', NULL, NULL, NULL),
(59, 45, '2024-05-06 09:18:17', 'Bonjour je suis le nouveau post de @glenmorton', NULL, NULL, NULL),
(60, 48, '2024-05-06 13:35:39', 'Bonjour à  tous !', '60.JPG', NULL, NULL),
(61, 48, '2024-05-06 13:36:09', 'Je suis bien arrivé en Italie ce matin quelle joie...', '61.JPG', NULL, NULL),
(62, 48, '2024-05-06 13:36:30', 'La tristesse de partir...', '62.JPG', NULL, NULL),
(63, 40, '2024-05-06 13:40:47', 'Test Pour l\'affichage des post', NULL, NULL, NULL),
(64, 48, '2024-05-06 13:41:03', 'okkk', NULL, NULL, NULL),
(65, 56, '2024-05-06 15:24:16', 'test', NULL, NULL, 1),
(66, 57, '2024-05-06 15:38:04', 'Premier Post, je suis TROP contente d\'être ici ', '66.JPG', NULL, NULL),
(67, 40, '2024-05-06 16:00:35', 'zezeze', NULL, NULL, NULL),
(83, 40, '2024-05-06 20:30:46', 'Nouveau post', '83.JPG', NULL, NULL),
(84, 45, '2024-05-06 20:39:06', 'Me voici dans une impasse ? ', '84.JPG', NULL, NULL);

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
  `profile_picture` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `age`, `birthday`, `email`, `password`, `pseudo`, `admin`, `profile_picture`) VALUES
(40, 'admin', 'admin', 24, 2000, 'admin@tzu.com', '$argon2id$v=19$m=65536,t=4,p=1$Uy5hQWJNUE5ZUnN6eDRMbg$I7y5+vPal6trTjdEnQroJ4lP8rwVgmz0YdcQk4djdv4', 'admin', 1, 'admin.jpeg'),
(45, 'Matteo', 'Chaouche', 24, 2000, 'glenmorton5555@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YkZVOTFxZFpLRnZGUExsQg$zIyP5EJ3ay5dITaPAiwEvM/4jOsnspjeAv48eqCcdgk', 'MorduDu7°', NULL, '45.JPG'),
(48, 'Thomas', 'Gredin', 28, 1996, 'tom.gredin@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$cUxPRHY5MmcwT3pjNHAyUg$3DrPD8V7UBAtGFgFWM9Pgqc8xyf/2p3JE6sTI2km5/s', 'stagram', NULL, '#92FDCE'),
(50, 'Léonie', 'Bertrand', 26, 1998, 'leoni.bertrand@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$cGgxVUxnTVczaWhCOHR2OQ$AroC9hlevwsZS61wYAeZb3vEesc8Vxqi9VXzUHUosr8', 'lolo', NULL, '#E826EC'),
(51, 'Jean', 'Valjean', 24, 2000, 'jean.valjean@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$REFlbmFORFhWMGZQLm1WSQ$mujiHkqfu8hEiP6g7Zo+19dcRPpLtr7rAuR8MEyzo5o', 'JeanValjean', NULL, '#531DA3'),
(52, 'Michel', 'Rost', 23, 2001, 'michel.rost@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$Ujc5Ti5lNmdmR0tTRWhORA$ZbVacQaFTGeWijU0hCgwauBsO3Zn0Rf2BYtS+pbVbLY', 'Miche', NULL, '#24A1DA'),
(53, 'Valentine', 'Cru', 21, 2003, 'valentine.cru@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MllOS0ZEbHp4N2pITzJSdA$rWOtc242mdK1wmIM7ks84Yvb19k2maq3PS1gpCMdtqY', 'vava', NULL, '#5FD1B8'),
(54, 'Robin', 'Moirot', 22, 2002, 'robin.moirot@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$SThxbVJkczh4a2ZLRlhIcQ$9SWtPa/WLFtR/Q5hBUwhiK4Arvo/FW3/N10FiwIIUlo', 'RORO', NULL, '#DF9395'),
(55, 'Hugo', 'Decrypte', 42, 1982, 'hugo.decrypte@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MXEudzVnRFcud2E1UjJmdA$pVBZ+V85L2wGtUvip03fFp87huSPvDD2nVXvnbgONNU', 'hugBig', NULL, '#E4376B'),
(56, 'Stephane', 'Jore', 35, 1989, 'stephane.jore@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$MTB6QTd2QWJtOFN4Q1lPRQ$bNp6DZIUXFTNr1svv+s9gXMQSEo9qr8qb3ZBzffZPU4', 'steph', NULL, '#D20D65'),
(57, 'Camille', 'Moiset', 20, 2004, 'camille.moiset@utbm.fr', '$argon2id$v=19$m=65536,t=4,p=1$RFdsRDNDbGZ6TDd3Y001aA$BL0/z5omHFIZaay6oYDvXyQ9iAYbjTab7sGpURvkNnU', 'camcam', NULL, '#5947C4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`id_user`);

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
  ADD KEY `idx_comment` (`id_comment`),
  ADD KEY `idx_follow` (`id_follow`),
  ADD KEY `idx_like_comment` (`id_like_comment`);

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
-- AUTO_INCREMENT pour la table `ban`
--
ALTER TABLE `ban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `likedcomment`
--
ALTER TABLE `likedcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT pour la table `likedpost`
--
ALTER TABLE `likedpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ban`
--
ALTER TABLE `ban`
  ADD CONSTRAINT `ban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_5` FOREIGN KEY (`id_follow`) REFERENCES `follow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_6` FOREIGN KEY (`id_like_comment`) REFERENCES `likedcomment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
