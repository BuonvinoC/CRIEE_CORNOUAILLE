-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 03 Mai 2019 à 12:57
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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

INSERT INTO `acheteur` (`mail`, `pwd`, `prenom`, `nom`, `adresse`, `ville`, `codePostal`) VALUES
('Buonvino.clement@gmail.com', '11061997', 'Clément', 'Buonvino', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `encherir`
--

CREATE TABLE IF NOT EXISTS `encherir` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL,
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
  `idLot` varchar(50) NOT NULL,
  `libelleLot` varchar(50) NOT NULL,
  `DatePeche` date NOT NULL,
  `prixActuel` int(11) NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL,
  `dateFinEnchere` datetime NOT NULL
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
  `idLot` int(11) NOT NULL,
  `libelleLot` varchar(30) NOT NULL,
  `poisson` varchar(100) NOT NULL,
  `datePeche` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier_temporaire`
--

CREATE TABLE IF NOT EXISTS `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL
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
ALTER TABLE `lot`
 ADD PRIMARY KEY (`idLot`);

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
ALTER TABLE `panier_temporaire`
ADD CONSTRAINT `panier_temporaire_ibfk_1` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
ADD CONSTRAINT `panier_temporaire_ibfk_2` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
