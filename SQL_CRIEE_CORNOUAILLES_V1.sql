-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 12 mars 2019 à 10:25
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

DROP DATABASE IF EXISTS CRIEE_CORNOUAILLES_V1;
CREATE DATABASE IF NOT EXISTS CRIEE_CORNOUAILLES_V1;
USE CRIEE_CORNOUAILLES_V1;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `crieev0`
--


--
-- Base de données :  `criee_cornouailles_v1`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE IF NOT EXISTS `acheteur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acheteur`
--



-- --------------------------------------------------------

--
-- Structure de la table `encherir`
--

CREATE TABLE IF NOT EXISTS `encherir` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` INT NOT NULL,
  `date_encherir` datetime NOT NULL,
  `prix_propose` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE IF NOT EXISTS `espece` (
  `idEspece` varchar(50) NOT NULL,
  `nomEsp` varchar(50) DEFAULT NULL,
  `nomSciEsp` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `espece`
--

INSERT INTO `espece` (`idEspece`, `nomEsp`, `nomSciEsp`, `image`) VALUES
('1', 'Cabillaud', 'Gadus morhua', 'cabillaud.png'),
('10', 'Turbot', 'Scophthalmus maximus', 'turbot.png'),
('2', 'Carpe', 'Cyprinus carpio', 'carpe.png'),
('3', 'Hareng', 'Clupea harengus', 'hareng.png'),
('4', 'Maquereau', ' Scomber scombrus', 'maquereau.png'),
('5', 'Sardine', 'Sardina pilchardus', 'sardine.png'),
('6', 'Saumon', 'Salmo Salar', 'saumon.png'),
('7', 'Sole', 'Solea solea', 'sole.png'),
('8', 'Thon', 'Thunnus thynnus', 'thon.png'),
('9', 'Truite', 'Salmo trutta', 'truite.png');

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE IF NOT EXISTS `lot` (
  `idLot` INT NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(50) NOT NULL,
  `DatePeche` date NOT NULL,
  `prixActuel` int(11) NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL,
  `dateFinEnchere` datetime NOT NULL,
  PRIMARY KEY(idLot)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lot`
--

INSERT INTO `lot` (`idLot`, `libelleLot`, `DatePeche`, `prixActuel`, `AcheteurMax`, `dateFinEnchere`) VALUES
('1', 'libelleLot', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2019-05-30 10:30:00');

--
-- Déclencheurs `lot`
--
DELIMITER //
DROP TRIGGER IF EXISTS `refuser_encherir_inferieur`;
CREATE TRIGGER `refuser_encherir_inferieur` BEFORE UPDATE ON `lot`
 FOR EACH ROW BEGIN
    IF NEW.prixActuel <= OLD.prixActuel THEN
SET NEW.prixActuel = OLD.prixActuel;
SET NEW.AcheteurMax = OLD.AcheteurMax;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `lot_proposé`
--

CREATE TABLE IF NOT EXISTS `lot_proposé` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(30) NOT NULL,
  `poisson` varchar(100) NOT NULL,
  `datePeche` date NOT NULL,
  PRIMARY KEY(idLot)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `lot` (`idLot`, `libelleLot`, `DatePeche`, `prixActuel`, `AcheteurMax`) VALUES
('1', 'libelleLot', '1997-05-14', 300, 'dfihf@fds.com');

--
-- Déclencheurs `lot`
--
DELIMITER $$
CREATE TRIGGER `refuser_encherir_inferieur` BEFORE UPDATE ON `lot` FOR EACH ROW BEGIN
    IF NEW.prixActuel <= OLD.prixActuel THEN
SET NEW.prixActuel = OLD.prixActuel;
SET NEW.AcheteurMax = OLD.AcheteurMax;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------
--
-- Structure de la table `panier_temporaire`
--

CREATE TABLE IF NOT EXISTS `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `enchere_remportee` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(30) NOT NULL,
  `prix` int NOT NULL,
  `acheteur` varchar(30) NOT NULL,
  PRIMARY KEY(idLot)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE IF NOT EXISTS `vendeur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
 ADD PRIMARY KEY (`mail`);

--
-- Index pour la table `encherir`
--
ALTER TABLE `encherir`
 ADD PRIMARY KEY (`mailAcheteur`,`idLot`,`date_encherir`), ADD KEY `FK_encherir_lot` (`idLot`);

--
-- Index pour la table `espece`
--
ALTER TABLE `espece`
 ADD PRIMARY KEY (`idEspece`);

--
-- Index pour la table `lot`
--


--
-- Index pour la table `panier_temporaire`
--
ALTER TABLE `panier_temporaire`
 ADD PRIMARY KEY (`mailAcheteur`,`idLot`), ADD KEY `idLot` (`idLot`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
 ADD PRIMARY KEY (`mail`);



--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `encherir`
--
ALTER TABLE `encherir`
ADD CONSTRAINT `FK_encherir_acheteur` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
ADD CONSTRAINT `FK_encherir_lot` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);

--
-- Contraintes pour la table `panier_temporaire`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
