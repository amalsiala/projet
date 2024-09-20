-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 avr. 2024 à 20:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `capitalrisque`
--

CREATE TABLE `capitalrisque` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `capitalrisque`
--

INSERT INTO `capitalrisque` (`id`, `nom`, `prenom`, `mail`, `cin`, `pseudo`, `mdp`) VALUES
(9, 'amal', 'siala', 'amal21siala@gmail.co', '15022512', 'amal', 'AmalAA22345#'),
(10, 'siala', 'amal', 'amal216siala@gmail.c', '15078900', 'amal', 'amal'),
(11, 'amal', 'siala', 'amalsiala@gmail.com', '15022512', 'hope', 'aMal2726#');

-- --------------------------------------------------------

--
-- Structure de la table `capitalrisqueprojet`
--

CREATE TABLE `capitalrisqueprojet` (
  `id` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idCapitalRisque` int(11) NOT NULL,
  `nbrActionsAchetees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `descriptionProjet` varchar(200) NOT NULL,
  `nbrActionsAVendre` int(11) NOT NULL,
  `nbrActionsVendues` int(11) NOT NULL,
  `prixAction` float NOT NULL,
  `idStartuper` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `startuper`
--

CREATE TABLE `startuper` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `nomEps` varchar(30) NOT NULL,
  `adresseEps` varchar(50) NOT NULL,
  `regCom` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `startuper`
--

INSERT INTO `startuper` (`id`, `nom`, `prenom`, `cin`, `mail`, `nomEps`, `adresseEps`, `regCom`, `pseudo`, `mdp`) VALUES
(15, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hope', 'Hopehope123#'),
(19, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hopeee', 'AMal2726#'),
(20, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hopeee', 'Amalq2726#'),
(21, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hopeee', 'aMalamal22#'),
(22, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hopeee', 'aMal27262002#'),
(23, 'amal', 'siala', '15022512', 'amal216siala@gmail.c', 'isg', 'marsa plage', 'A1231232222', 'hopeee', 'aMal27262002#');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `capitalrisque`
--
ALTER TABLE `capitalrisque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `capitalrisqueprojet`
--
ALTER TABLE `capitalrisqueprojet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_projet` (`idProjet`),
  ADD KEY `id_capital_risque` (`idCapitalRisque`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `id_startuper` (`idStartuper`);

--
-- Index pour la table `startuper`
--
ALTER TABLE `startuper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `capitalrisque`
--
ALTER TABLE `capitalrisque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `capitalrisqueprojet`
--
ALTER TABLE `capitalrisqueprojet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `startuper`
--
ALTER TABLE `startuper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capitalrisqueprojet`
--
ALTER TABLE `capitalrisqueprojet`
  ADD CONSTRAINT `capitalrisqueprojet_ibfk_1` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`id_projet`),
  ADD CONSTRAINT `capitalrisqueprojet_ibfk_2` FOREIGN KEY (`idCapitalRisque`) REFERENCES `capitalrisque` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`idStartuper`) REFERENCES `startuper` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
