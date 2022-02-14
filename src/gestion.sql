-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 fév. 2022 à 12:40
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptelec`
--

DROP TABLE IF EXISTS `comptelec`;
CREATE TABLE IF NOT EXISTS `comptelec` (
  `idUser` int(20) NOT NULL,
  `dateInter` date NOT NULL,
  `Rendezvous` int(20) NOT NULL,
  `Accesible` int(20) NOT NULL,
  `Grip` int(20) NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptelec`
--

INSERT INTO `comptelec` (`idUser`, `dateInter`, `Rendezvous`, `Accesible`, `Grip`) VALUES
(1, '2022-02-09', 0, 0, 0),
(1, '2022-02-09', 0, 0, 0),
(1, '2022-02-09', 0, 0, 0),
(1, '2022-02-09', 1, 0, 0),
(1, '2022-02-09', 4, 1, 1),
(1, '2022-02-10', 3, 3, 3),
(1, '2022-02-10', 3, 3, 3),
(1, '2022-02-10', 2, 1, 1),
(1, '2022-02-10', 1, 1, 1),
(1, '2022-02-10', 1, 1, 1),
(1, '2022-02-10', 2, 1, 3),
(1, '2022-02-10', 3, 2, 2),
(1, '2022-02-10', 15, 0, 0),
(1, '2022-02-10', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `comptgaz`
--

DROP TABLE IF EXISTS `comptgaz`;
CREATE TABLE IF NOT EXISTS `comptgaz` (
  `idUser` int(20) NOT NULL,
  `dateInter` date NOT NULL,
  `Rendez-vous` int(20) NOT NULL,
  `Sans rendez-vous` int(20) NOT NULL,
  `Module` int(20) NOT NULL,
  `Détendeur` int(20) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `us`
--

DROP TABLE IF EXISTS `us`;
CREATE TABLE IF NOT EXISTS `us` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `firstName` text NOT NULL,
  `type` enum('admin','electricité','gaz') NOT NULL,
  `userName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `us`
--

INSERT INTO `us` (`id`, `name`, `firstName`, `type`, `userName`) VALUES
(1, 'nomelec1', 'prenomelec1', 'electricité', ''),
(2, 'nomelec2', 'prenomelec2', 'electricité', ''),
(3, 'nomelec3', 'prenomelec3', 'electricité', ''),
(4, 'nomelec4', 'prenomelec4', 'electricité', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `firstName` text NOT NULL,
  `type` enum('admin','gaz','elecrticite','') NOT NULL,
  `userName` varchar(100) NOT NULL,
  `passWord` varchar(100) NOT NULL,
  `secret` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstName`, `type`, `userName`, `passWord`, `secret`) VALUES
(1, 'rabie', 'rabie', 'admin', 'rabie', 'rabie', 'rabie'),
(2, 'rabie', 'gharghar', 'gaz', 'nan', 'rara', 'rara'),
(12, 'gaz', 'gaz', 'gaz', 'gaz', 'gaz', 'gaz'),
(13, 'Abou', 'CISSE', 'gaz', 'Abou', '123f201bc267079ce07e540bca175e1f29def633727', '123f201bc267079ce07e540bca175e1f29def633727'),
(14, 'elec', 'elec', 'elecrticite', 'elec', 'elec', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comptelec`
--
ALTER TABLE `comptelec`
  ADD CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comptgaz`
--
ALTER TABLE `comptgaz`
  ADD CONSTRAINT `idUsers` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
