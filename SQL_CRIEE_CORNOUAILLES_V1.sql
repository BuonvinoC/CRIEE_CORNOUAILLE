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


-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE IF NOT EXISTS `lot` (
  `idLot` INT NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(50) NOT NULL,
  `DatePeche` date NOT NULL,
  `prixActuel` int(20) NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL,
  `dateFinEnchere` datetime NOT NULL,
  `idEsp` varchar(50) NULL,
  `poids` int(20) NULL, -- IL FAUDRA LE METTRE EN NOT NULL PLUS TARD
  PRIMARY KEY(idLot)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Structure de la table `lot_proposé`
--

CREATE TABLE IF NOT EXISTS `lot_proposé` (
  `idLot` int(11) NOT NULL AUTO_INCREMENT,
  `libelleLot` varchar(30) NOT NULL,
  `poisson` varchar(100) NOT NULL,
  `datePeche` date NOT NULL,
  `poids` int(20) NULL, -- IL FAUDRA LE METTRE EN NOT NULL PLUS TARD
  PRIMARY KEY(idLot)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `lot_remporté` (
  `idLot` int NOT NULL,
  
  PRIMARY KEY(idLot)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Déclencheurs `lot`


-- --------------------------------------------------------
--
-- Structure de la table `panier_temporaire`
--

CREATE TABLE IF NOT EXISTS `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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




DELIMITER $$
CREATE TRIGGER `refuser_encherir_inferieur` BEFORE UPDATE ON `lot` FOR EACH ROW BEGIN
    IF NEW.prixActuel <= OLD.prixActuel THEN
SET NEW.prixActuel = OLD.prixActuel;
SET NEW.AcheteurMax = OLD.AcheteurMax;
END IF;
END
$$
DELIMITER ;

--
-- Index pour les tables exportées
--

INSERT INTO `espece` (`idEspece`, `nomEsp`, `nomSciEsp`, `image`) VALUES
('CAB', 'Cabillaud', 'Gadus morhua', 'cabillaud.png'),
('TURB', 'Turbot', 'Scophthalmus maximus', 'turbot.png'),
('CARP', 'Carpe', 'Cyprinus carpio', 'carpe.png'),
('HARG', 'Hareng', 'Clupea harengus', 'hareng.png'),
('MAQ', 'Maquereau', ' Scomber scombrus', 'maquereau.png'),
('SARD', 'Sardine', 'Sardina pilchardus', 'sardine.png'),
('SAU', 'Saumon', 'Salmo Salar', 'saumon.png'),
('SOL', 'Sole', 'Solea solea', 'sole.png'),
('THON', 'Thon', 'Thunnus thynnus', 'thon.png'),
('TRU', 'Truite', 'Salmo trutta', 'truite.png');


INSERT INTO `lot` (`idLot`, `libelleLot`, `DatePeche`, `prixActuel`, `AcheteurMax`, `dateFinEnchere`, `idEsp`, `poids`) VALUES
(1, 'libelleLot', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2019-05-30 10:30:00','CARP', 50),
(2, 'Gros pack de harengs', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2019-05-30 12:30:00','HARG', 100),
(3, 'Lot de harengs peu utilisés', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2111-11-11 11:11:11','HARG', 12),
(4, 'Je vends ma femme, bon etat', '2019-05-14', 500, 'Buonvino.clement@gmail.com', '2019-02-30 09:30:00','THON', 666);


INSERT INTO `lot_remporté`(idLot) VALUES (1);



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
ALTER TABLE `lot_remporté`
ADD CONSTRAINT `FK_lotRemp_Lot` FOREIGN KEY (`idLot`) REFERENCES `lot`(`idLot`);

--
-- Index pour la table `panier_temporaire`
--
ALTER TABLE `panier_temporaire`
 ADD PRIMARY KEY (`mailAcheteur`,`idLot`),


 ADD CONSTRAINT `FK_panier_acheteur` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur`(`mail`),
ADD CONSTRAINT `FK_panier_lot` FOREIGN KEY (`idLot`) REFERENCES `lot`(`idLot`);
--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
 ADD PRIMARY KEY (`mail`);


ALTER TABLE `lot`
ADD CONSTRAINT `FK_lot_espece` FOREIGN KEY (`idEsp`) REFERENCES `espece`(`idEspece`);
--
-- Contraintes pour lots remportés



-- Contraintes pour la table `encherir`

ALTER TABLE `encherir`
ADD CONSTRAINT `FK_encherir_acheteur` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
ADD CONSTRAINT `FK_encherir_lot` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);



--  ***************************   L E S   I N S E R T S   *****************************************************************************************







-- ************************************************************************************************************************************************ 



-- *************************************** L E   S E L E C T   D E S   L O T S   R E M P O R T E S  ***************************************************************** 

-- SELECT lot_remporté.idLot, lot.libelleLot, lot.prixActuel, lot.AcheteurMax, lot.idEsp, espece.image FROM lot_remporté, lot, espece
-- where lot_remporté.idLot = lot.idLot and lot.idEsp = espece.idEspece;

-- **************************************** L E   S E L E C T   D E S   L O T S   P A S   E N C O R E   R E M P O R T E S ***********************************************************************


-- SELECT * FROM LOT WHERE LOT.idLot NOT IN (SELECT idLot FROM lot_remporté)


-- ************************************************************************************************************************************************ 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


