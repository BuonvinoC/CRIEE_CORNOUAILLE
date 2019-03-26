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

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE `acheteur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL
 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
CREATE TABLE `vendeur`(
`mail` varchar(50) NOT NULL,
`pwd` varchar(50) DEFAULT NULL,
`prenom` varchar(50) DEFAULT NULL,
`nom` varchar(50) DEFAULT NULL,
`adresse` varchar(50) DEFAULT NULL,
`ville` varchar(50) DEFAULT NULL,
`codePostal` varchar(50) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `idEspece` varchar(50) NOT NULL,
  `nomEsp` varchar(50) DEFAULT NULL,
  `nomSciEsp` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `idLot` varchar(50) NOT NULL,
  `libelleLot` varchar(50) NOT NULL,
  `DatePeche` date NOT NULL,
  `prixActuel` int NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot`
--
-- --------------------------------------------------------

--
-- Structure de la table `panier_intermedaire`
--

CREATE TABLE `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `panier_temporaire`
  ADD PRIMARY KEY (`mailAcheteur`,`idLot`);

--
CREATE TABLE `encherir` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL,
  `date_encherir`  datetime not null,
  `prix_propose` float
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `encherir`
  ADD constraint `pk_encherir` PRIMARY KEY (`mailAcheteur`,`idLot`, `date_encherir`);
    

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`mail`);
  
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`mail`);

-- Index pour la table `espece`
--
ALTER TABLE `espece`
  ADD PRIMARY KEY (`idEspece`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`idLot`);

  ALTER TABLE `encherir`
  ADD CONSTRAINT `FK_encherir_acheteur` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur`(`mail`),
	ADD CONSTRAINT `FK_encherir_lot` FOREIGN KEY (`idLot`) REFERENCES `lot`(`idLot`);
--

ALTER TABLE `panier_temporaire`
  ADD constraint FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur`(`mail`);
ALTER TABLE `panier_temporaire`
  ADD constraint FOREIGN KEY (`idLot`) REFERENCES `lot`(`idLot`);




INSERT INTO ESPECE
VALUES
(1, 'Cabillaud', 'Gadus morhua', 'cabillaud.png'),
(2, 'Carpe', 'Cyprinus carpio', 'carpe.png'),
(3, 'Hareng', 'Clupea harengus', 'hareng.png'),
(4, 'Maquereau', ' Scomber scombrus', 'maquereau.png'),
(5, 'Sardine', 'Sardina pilchardus', 'sardine.png'),
(6, 'Saumon', 'Salmo Salar', 'saumon.png'),
(7, 'Sole', 'Solea solea', 'sole.png'),
(8, 'Thon', 'Thunnus thynnus', 'thon.png'),
(9, 'Truite', 'Salmo trutta', 'truite.png'),
(10, 'Turbot', 'Scophthalmus maximus', 'turbot.png');
--
-- Contraintes pour les tables déchargées


--
-- Contraintes pour la table `panier_intermedaire`
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
