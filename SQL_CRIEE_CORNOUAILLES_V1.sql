-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 26 mars 2019 à 12:03
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

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
  `prixActuel` int(11) NOT NULL,
  `AcheteurMax` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lot`
--

INSERT INTO `lot` (`idLot`, `libelleLot`, `DatePeche`, `prixActuel`, `AcheteurMax`) VALUES
('44', '', '0000-00-00', 300, '');

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

CREATE TABLE `panier_temporaire` (
  `mailAcheteur` varchar(50) NOT NULL,
  `idLot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`mail`);

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
  ADD PRIMARY KEY (`mailAcheteur`,`idLot`),
  ADD KEY `idLot` (`idLot`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`mail`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier_temporaire`
--
ALTER TABLE `panier_temporaire`
  ADD CONSTRAINT `panier_temporaire_ibfk_1` FOREIGN KEY (`mailAcheteur`) REFERENCES `acheteur` (`mail`),
  ADD CONSTRAINT `panier_temporaire_ibfk_2` FOREIGN KEY (`idLot`) REFERENCES `lot` (`idLot`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
