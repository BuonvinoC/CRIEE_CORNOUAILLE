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
USE DATABASE CRIEE_CORNOUAILLES_V1;


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
--
-- Structure de la table `bac`
--

CREATE TABLE `bac` (
  `idBac` varchar(50) NOT NULL,
  `tare` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `idEspece` varchar(50) NOT NULL,
  `nomEsp` varchar(50) DEFAULT NULL,
  `nomSciEsp` varchar(50) DEFAULT NULL,
  `nomComEsp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `idLot` varchar(50) NOT NULL,
  `libelleLot` varchar(50) NOT NULL,
  `LienimageLot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`idLot`, `libelleLot`, `LienimageLot`) VALUES
('005', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `panier_intermedaire`
--

CREATE TABLE `panier_intermedaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`mail`);
  
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`mail`);

--
-- Index pour la table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`idBac`);

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
-- Index pour la table `panier_intermedaire`
--
ALTER TABLE `panier_intermedaire`
  ADD PRIMARY KEY (`mailAcheteur`,`idLot`),
  ADD KEY `FK_PANINER_INTER_2` (`idLot`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier_intermedaire`
--
ALTER TABLE `panier_intermedaire`
  ADD CONSTRAINT `FK_PANINER_INTER_1` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
  ADD CONSTRAINT `FK_PANINER_INTER_2` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
