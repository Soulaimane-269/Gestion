-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 fév. 2022 à 13:15
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
  `Rendez_vous` int(11) NOT NULL,
  `Sans_rendez_vous` int(11) NOT NULL,
  `Module` int(11) NOT NULL,
  `Detendeur` int(11) NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `comptegaz`
--

INSERT INTO `comptegaz` (`idUser`, `dateInter`, `Rendez_vous`, `Sans_rendez_vous`, `Module`, `Detendeur`) VALUES
(105, '2022-02-07', 1, 1, 2, 2),
(105, '2022-01-05', 3000, 4527, 41, 41),
(105, '2022-02-22', 10, 10, 10, 5),
(105, '2022-02-16', 10, 0, 10, 1),
(105, '2022-01-20', 10, 0, 10, 0),
(105, '2022-01-22', 100, 50, 100, 74),
(105, '2022-02-24', 0, 0, 0, 0);

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
(1, '2022-02-07', 10, 10, 10),
(101, '2022-02-21', 10, 2, 0),
(1, '2022-02-16', 15, 15, 15),
(101, '2022-02-16', 15, 15, 15),
(101, '2022-02-07', 10, 100, 10),
(101, '2022-02-02', 10, 0, 0),
(106, '2022-02-22', 2, 2, 8),
(106, '2022-02-10', 10, 10, 0),
(106, '2022-02-23', 0, 0, 0),
(108, '2022-02-23', 10, 5, 3),
(108, '2022-02-24', 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstName`, `type`, `userName`, `passWord`, `secret`) VALUES
(104, 'adminm', 'adminm', 'admin', 'admin', '123d033e22ae348aeb5660fc2140aec35850c4da997', '123d033e22ae348aeb5660fc2140aec35850c4da997'),
(105, 'gaz', 'gaz', 'gaz', 'gaz', '12347a126d932fff58b40ef2de6e148df775551d9d4', '12347a126d932fff58b40ef2de6e148df775551d9d4'),
(106, 'elec', 'elec', 'electricite', 'elec', '123c2726d0945f620311e9061335017657e9a946527', '123c2726d0945f620311e9061335017657e9a946527'),
(107, 'gaz2', 'gaz2', 'gaz', 'gaz2', '123f3d234e3ccdb7540409375e8e692382089cc3f49', '123f3d234e3ccdb7540409375e8e692382089cc3f49'),
(108, 'Abou', 'CISSE', 'electricite', 'Abou', '123f201bc267079ce07e540bca175e1f29def633727', '123f201bc267079ce07e540bca175e1f29def633727');

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
