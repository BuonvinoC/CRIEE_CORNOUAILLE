-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 09 mai 2019 à 12:36
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `criee_cornouailles_v1`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`mail`, `pwd`, `prenom`, `nom`, `adresse`, `ville`, `codePostal`) VALUES
('admin', 'admin', 'admin', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `encherir`
--

DROP TABLE IF EXISTS `encherir`;
CREATE TABLE IF NOT EXISTS `encherir` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` int(11) NOT NULL,
  `date_encherir` datetime NOT NULL,
  `prix_propose` float DEFAULT NULL,
  PRIMARY KEY (`mailAcheteur`,`idLot`,`date_encherir`),
  KEY `FK_encherir_lot` (`idLot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `idEspece` varchar(50) NOT NULL,
  `nomEsp` varchar(50) DEFAULT NULL,
  `nomSciEsp` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEspece`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `espece`
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

DROP TABLE IF EXISTS `lot`;
CREATE TABLE IF NOT EXISTS `lot` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(50) NOT NULL,
  `DatePeche` date NOT NULL,
  `prixActuel` int(11) NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL,
  `dateFinEnchere` datetime NOT NULL,
  PRIMARY KEY (`idLot`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`idLot`, `libelleLot`, `DatePeche`, `prixActuel`, `AcheteurMax`, `dateFinEnchere`) VALUES
(1, 'libelleLot', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2019-05-30 10:30:00'),
(2, 'penis', '2038-02-02', 300, '', '2018-05-08 18:59:00');

--
-- Déclencheurs `lot`
--
DROP TRIGGER IF EXISTS `refuser_encherir_inferieur`;
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
-- Structure de la table `lot_proposé`
--

DROP TABLE IF EXISTS `lot_proposé`;
CREATE TABLE IF NOT EXISTS `lot_proposé` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(30) NOT NULL,
  `poisson` varchar(100) NOT NULL,
  `datePeche` date NOT NULL,
  PRIMARY KEY (`idLot`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot_proposé`
--

INSERT INTO `lot_proposé` (`idLot`, `libelleLot`, `poisson`, `datePeche`) VALUES
(1, 'penis', 'penis', '2038-02-02');

-- --------------------------------------------------------

--
-- Structure de la table `lot_remporté`
--

DROP TABLE IF EXISTS `lot_remporté`;
CREATE TABLE IF NOT EXISTS `lot_remporté` (
  `idLot` int(11) NOT NULL,
  PRIMARY KEY (`idLot`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot_remporté`
--

INSERT INTO `lot_remporté` (`idLot`) VALUES
(2);

-- --------------------------------------------------------

--
-- Structure de la table `panier_temporaire`
--

DROP TABLE IF EXISTS `panier_temporaire`;
CREATE TABLE IF NOT EXISTS `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL,
  PRIMARY KEY (`mailAcheteur`,`idLot`),
  KEY `idLot` (`idLot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `encherir`
--
ALTER TABLE `encherir`
  ADD CONSTRAINT `FK_encherir_acheteur` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
  ADD CONSTRAINT `FK_encherir_lot` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
