-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 oct. 2023 à 10:25
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `td_exemple_final`
--
CREATE DATABASE IF NOT EXISTS `td_exemple_final` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `td_exemple_final`;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `ID` int(10) UNSIGNED NOT NULL,
  `logname` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`ID`, `logname`, `password`) VALUES
(12, 'Serina', '01ac4fa82f682d88eccbec67959b24b3'),
(13, 'VictoryBelle', 'cdf9f7a0ff8dd15c7254e8dd05feb9c6'),
(14, 'PHPguys', '6757196c1101d0fe4d0a242fb100b95f'),
(15, 'WE4A', '6757196c1101d0fe4d0a242fb100b95f'),
(16, 'BigGuy', 'eb5c1399a871211c7e7ed732d15e3a8b'),
(17, 'Naruto999', 'ab15d3d5a61c3722186dae6bf393b8f7'),
(20, 'Zeratul', '3a36e938cce27d3d6f85d19ab9e318a5'),
(21, 'Zoulou', '36f3b2748cea3f5714d849889bb4a0c7'),
(22, 'ChinetoqueNinja', '5a3715ac749a407d5e7780e14d3bd251'),
(23, 'Michel', 'd7c7ace0ceeabcba5535e6cafe277841'),
(24, 'Cyril', 'f69eaec2546272f0de9322cc2c51b55a');

-- --------------------------------------------------------

--
-- Structure de la table `persogeek`
--

CREATE TABLE `persogeek` (
  `ID` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `persogeek`
--

INSERT INTO `persogeek` (`ID`, `nom`) VALUES
(1, 'Harry Potter'),
(2, 'Mickey Mouse'),
(3, 'Tony Soprano'),
(4, 'Buffy Vampire Slayer'),
(5, 'Sherlock Holmes'),
(6, 'Wonder Woman'),
(7, 'Dracula'),
(8, 'Homer Simpson'),
(9, 'Ellen Ripley'),
(10, 'Dark Vador'),
(11, 'Betty Boop'),
(12, 'Superman'),
(13, 'Dirty Harry'),
(14, 'Bugs Bunny'),
(15, 'Scarlett O\'Hara'),
(16, 'E.T. l\'extra-terrestre'),
(17, 'Hannibal Lecter'),
(18, 'Batman'),
(19, 'Kermit'),
(20, 'Fred Pierrafeu'),
(21, 'Indiana Jones'),
(22, 'Pinocchio'),
(23, 'Lucy Ricardo'),
(24, 'Frankenstein'),
(25, 'Gandalf'),
(26, 'Anne Shirley'),
(27, 'Peter Pan');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `ID_post` int(10) UNSIGNED NOT NULL,
  `date_lastedit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(100) NOT NULL,
  `content` varchar(8000) NOT NULL,
  `image_url` varchar(70) DEFAULT NULL,
  `owner_login` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`ID_post`, `date_lastedit`, `title`, `content`, `image_url`, `owner_login`) VALUES
(2, '2022-03-15 07:24:23', 'Un test', 'Voici un test pour un autre utilisateur', NULL, 13),
(3, '2023-10-20 08:20:25', 'Utilisateur fictif!', 'Savez vous que les noms d\'utilisateur de ce test sont, pour beaucoup, les noms de personnages de BD amateur crées par le prof? Non? \r\nNormal, il a jamais eu de succès sur ce plan! XD', 'Uploads/12_041223194625.jpg', 12),
(6, '2023-10-20 08:19:38', 'Milky a encore bouffé les cookies!', 'Il est lourd, quand même!', NULL, 12),
(31, '2023-04-12 19:01:17', 'Test d\'image', 'J\'uploade une image.', 'Uploads/14_041223190117.jpg', 14),
(32, '2023-10-20 08:21:04', 'En Taro Tassadar!', 'Ben oui, quoi, je suis un vieux gamer des années 90, moi!', NULL, 20),
(33, '2023-10-20 08:22:16', 'Chinetoque ninja!', 'Le meilleur film de tous les temps! Dans lequel le livreur de riz il fait un mawashigeri dans sa tête à l\'araignée! \r\n(cf le sketch des Guignols de l\'info)', NULL, 22),
(37, '2023-10-20 08:19:10', 'Gooood Morning Kinshassa!', 'Oui, bon, désolé, pour comprendre, faudrait que quelqu\'un d\'autre que moi aie lu ma nouvelle de science-fiction pourrie et même pas terminée.', NULL, 24),
(38, '2023-10-20 08:17:30', 'Projet : cette démo est une ressource!', 'N&#039;oubliez pas : vous avez le droit d&#039;utiliser des morceaux du code de cette démo dans votre projet. (du moment que vous créditez honnêtement!)\r\n\r\nCette démo a des défauts, donc pour une meilleure note, vous pouvez : corrigez les petits problèmes de la démo (il y en a!), améliorez les visuels ou la sécurité, ajoutez des fonctionnalités, etc, etc...', 'Uploads/15_102023101730.jpg', 15),
(39, '2023-10-20 08:13:57', 'Photo de l&#039;UTBM', 'Plus adapté à  l&#039;UV que mes vieilles images du semestre précédent! XD', 'Uploads/15_102023101357.jpg', 15),
(44, '2023-04-12 07:26:30', 'Et le Thumbnail?', 'On teste le thumbnail', 'Uploads/15_041223072630.jpg', 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `persogeek`
--
ALTER TABLE `persogeek`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID_post`),
  ADD KEY `LINK` (`owner_login`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `persogeek`
--
ALTER TABLE `persogeek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `ID_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `Test` FOREIGN KEY (`owner_login`) REFERENCES `login` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
