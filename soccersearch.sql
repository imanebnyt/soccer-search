-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 jan. 2023 à 06:54
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `soccersearch`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `IdUtil` int(11) NOT NULL,
  `IdClub` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `numTel` int(11) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`IdUtil`, `IdClub`, `Nom`, `Prénom`, `email`, `numTel`, `age`) VALUES
(3, 93, 'AZDAZD', 'Maz', 'mahydinegame@gmail.com', 0, 0),
(5, 1, 'sqdf', 'qdsfqsdf', 'qsdfqsdf', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `clubfoot`
--

CREATE TABLE `clubfoot` (
  `IdClub` int(11) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `age` varchar(255) NOT NULL,
  `Nbr_adh` int(11) NOT NULL,
  `Nbr_adh_max` int(11) NOT NULL,
  `NomClub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clubfoot`
--

INSERT INTO `clubfoot` (`IdClub`, `Adresse`, `latitude`, `longitude`, `age`, `Nbr_adh`, `Nbr_adh_max`, `NomClub`) VALUES
(1, '162 Rue des Cités, 93300 Aubervilliers', 48.9128, 2.38921, '14', 23, 26, 'ASJA-Aubervilliers'),
(2, '19 Rue du 14 Juillet, 93310 Le Pré-Saint-Gervais', 48.8866, 2.40188, '8', 11, 26, 'APSAP-St-Gervais'),
(22, '31 avenue de la République, 75011 Paris', 48.8658, 2.37263, '16', 22, 22, 'Les Ballons dOr'),
(23, '44 rue de la Convention, 75015 Paris', 48.844, 2.28135, '17', 22, 22, 'Les Aigles de la Victoire'),
(24, '2 rue de la Pompe, 75116 Paris', 48.8634, 2.27677, '18', 20, 22, 'Les Flèches du Triomphe'),
(25, '58 rue du Faubourg Saint-Honoré, 75008 Paris', 48.8696, 2.31926, '19', 21, 22, 'Les Lions de lHonneur'),
(26, '6 rue de la Boétie, 75008 Paris', 48.5502, 2.42015, '7', 22, 22, 'Les Étoiles du Succès'),
(27, '76 avenue des Champs-Élysées, 75008 Paris', 48.8712, 2.30435, '21', 14, 22, 'Les Vainqueurs de lÉlysée'),
(28, '86 rue de Rivoli, 75001 Paris', 48.8581, 2.34993, '22', 15, 22, 'Les Chevaliers de la Conquête'),
(29, '2 avenue Foch, 75116 Paris', 48.8738, 2.29308, '15', 22, 22, 'Les Gladiateurs de la Victoire'),
(30, '47 boulevard Haussmann, 75009 Paris', 48.8734, 2.32954, '16', 22, 22, 'Les As de lExcellence'),
(31, '64 rue de Grenelle, 75007 Paris', 48.8547, 2.32528, '9', 18, 22, 'Les Élégants du Triomphe'),
(93, '145 avenue de versailles, 75016 paris', 48.8419, 2.26758, '8', 8, 32, 'IUT Descartes');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdUser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `estAdmin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUser`, `username`, `userPassword`, `estAdmin`) VALUES
(3, 'Mahydine', '$2y$10$LvibB5mqyDVVD0zAfKfvaeT6WRRvkpDi1zZwPbX05esdQMRt1ZVfi', 0),
(5, 'Admin', '$2y$10$5owWIEOHiXTqsxJ.NfjD6.U2SSNER2nDR.1sXRGzY9CQ51gyRZyGe', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`IdUtil`,`IdClub`),
  ADD KEY `IdClub` (`IdClub`);

--
-- Index pour la table `clubfoot`
--
ALTER TABLE `clubfoot`
  ADD PRIMARY KEY (`IdClub`),
  ADD UNIQUE KEY `Adresse` (`Adresse`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `ident` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clubfoot`
--
ALTER TABLE `clubfoot`
  MODIFY `IdClub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`IdUtil`) REFERENCES `utilisateurs` (`IdUser`),
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`IdClub`) REFERENCES `clubfoot` (`IdClub`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
