-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 mars 2022 à 10:06
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
-- Structure de la table `comptegaz`
--

DROP TABLE IF EXISTS `comptegaz`;
CREATE TABLE IF NOT EXISTS `comptegaz` (
  `idUser` int(11) NOT NULL,
  `dateInter` date NOT NULL,
  `Pose compteur, Sans RDVN, Sans repérage` int(11) NOT NULL,
  `Pose compteur, Avec RDVN, Sans repérage` int(11) NOT NULL,
  `Pose compteur, Avec repérage` int(11) NOT NULL,
  `Pose module, Sans RDVN, Sans repérage` int(11) NOT NULL,
  `Pose module, Avec RDVN, Sans repérage` int(11) NOT NULL,
  `Pose module, Avec repérage` int(11) NOT NULL,
  `Recensement+remplacement détendeur` int(11) NOT NULL,
  `Recensement détendeur` int(11) NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comptelec`
--

DROP TABLE IF EXISTS `comptelec`;
CREATE TABLE IF NOT EXISTS `comptelec` (
  `idUser` int(20) NOT NULL,
  `dateInter` date NOT NULL,
  `Rendez-vous` int(20) NOT NULL,
  `Accessible` int(20) NOT NULL,
  `Grip` int(20) NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `firstName` text NOT NULL,
  `type` enum('admin','gaz','electricite','') NOT NULL,
  `userName` varchar(100) NOT NULL,
  `passWord` varchar(100) NOT NULL,
  `secret` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstName`, `type`, `userName`, `passWord`, `secret`) VALUES
(1, 'adminm', 'adminm', 'admin', 'admin', '123d033e22ae348aeb5660fc2140aec35850c4da997', '123d033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'gaz', 'gaz', 'gaz', 'gaz', '12347a126d932fff58b40ef2de6e148df775551d9d4', '12347a126d932fff58b40ef2de6e148df775551d9d4'),
(3, 'elec', 'elec', 'electricite', 'elec', '123c2726d0945f620311e9061335017657e9a946527', '123c2726d0945f620311e9061335017657e9a946527'),
(4, 'tech3', 'tech3', 'gaz', 'tech3', '1239364f6f48c8e3fd96ce8487d7b3516cad73ab138', '1239364f6f48c8e3fd96ce8487d7b3516cad73ab138'),
(5, 'tech4', 'tech4', 'electricite', 'tech4', '123edb9e3ffaa0a7719635456a86b36e24712003991', '123edb9e3ffaa0a7719635456a86b36e24712003991'),
(6, 'I-Energie', 'fatima', 'gaz', 'Abou', '1237430bf9377eba7815cda3f388ab4466160b7ce33', '123f201bc267079ce07e540bca175e1f29def633727');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comptegaz`
--
ALTER TABLE `comptegaz`
  ADD CONSTRAINT `comptegaz_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
