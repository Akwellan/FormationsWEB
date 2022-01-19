-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 jan. 2022 à 11:55
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formations`
--
CREATE DATABASE IF NOT EXISTS `formations` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `formations`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `rang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `user`, `rang`) VALUES
(1, 'benjamin.thierry', 'admin'),
(3, 'isabelle.kieffer', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `groupe` varchar(255) DEFAULT 'ALL',
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `nom`, `description`, `groupe`, `video`) VALUES
(27, 'Bonne pratique informatique', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a rhoncus tortor. Ut sodales, lacus at luctus tristique, nisl quam convallis libero, vitae faucibus erat ex sed nulla. Suspendisse a diam a eros vestibulum rhoncus id vel erat. Duis et lobortis mi. Suspendisse tristique, velit at suscipit sodales, nisl quam semper sapien, quis bibendum arcu tortor ac nunc.', 'ALL', 'Formation BPI v2.mp4'),
(30, 'Test', 'n\r\nghn\r\nghrytrhgfg', 'ALL', 'Montage Formation BPI-3.mp4');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT 'NULL',
  `reponse` varchar(255) NOT NULL,
  `reponse_vrai` varchar(255) NOT NULL,
  `id_formations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `nom`, `description`, `reponse`, `reponse_vrai`, `id_formations`) VALUES
(40, 'Identifiant', 'Comment est composé l\'identifiant informatique : ', 'prenom.nom|nom.prenom|prenomnom', '0|', 27),
(41, 'Dossier partagé', 'Quel est le dossier ou tous les collaborateurs ICARE ont accès ?', '\\\\SRVDATA\\Partage|\\\\SRVDATA\\ALLUser|\\\\SRVDATA\\Commun', '2|', 27),
(42, 'Interdiction', 'Quel réponse est bonne ?', 'L\'usage d\'une clef USB personnelle est interdite|L\'usage d\'un support externe personnelle est autorisé|Vous ne devez en aucun cas communiquer vos identifiants/mot de passe', '0|2|', 27),
(43, 'Sécurité', 'Vous ne devez pas ... ?', 'Connectez un appareil ICARE à un réseau public |Désactiver l\'antivirus, ou le stopper|Faire les mise à jour des équipements informatiques', '0|1|', 27),
(44, 'Mot de passe', 'Quel complexité doit avoir un mot de passe au sein d\'ICARE ?', 'Dix caractères / Une majuscule / Un chiffre / Une minuscule|Dix caractères / Une majuscule / Un chiffre / Une minuscule / Un caractère spécial|Dix caractères / Une majuscule OU Un chiffre OU Une minuscule', '1|', 27),
(45, 'Communication', 'Quel est l\'outil utilisé pour communiquer chez ICARE ?', 'Messenger|Teams|Nextcloud', '1|', 27),
(46, 'Outil de bureautique', 'Quels sont les outils minima utilisé avec un compte Office  ICARE ?', 'Un accès OFFICE 365 (World/Excel/Power Point) via le WEB |Un accès OFFICE 365 (World/Excel/Power Point) en local|Un accès à Outlook', '0|1|2|', 27),
(47, 'Réseau ', 'Sur le réseau ICARE vous avez accès à votre dossier personnel pour sauvegarder tout votre travail mais ou ce trouve celui-ci ?', '\\\\SRVDATA\\users\\prenom.nom|\\\\SRVDATA\\prenom.nom|\\\\SRVDATA\\users\\nom.prenom', '0|', 27),
(69, 'gjhfg', 'hgfhnfgn ?', 'gjgh|jkl|5434', '0|1|', 30),
(70, 'rhjghj', 'khjkhjlk ', '63453|32jhk|jhkhj', '1|', 30);

-- --------------------------------------------------------

--
-- Structure de la table `reussite`
--

DROP TABLE IF EXISTS `reussite`;
CREATE TABLE `reussite` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_formations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reussite`
--

INSERT INTO `reussite` (`id`, `user`, `point`, `date`, `id_formations`) VALUES
(45, 'benjamin.thierry', 88, '2022-01-12', 27),
(46, 'adminondemand2', 88, '2022-01-10', 27),
(47, 'benjamin.thierry', 100, '2022-01-10', 30);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_formations` (`id_formations`);

--
-- Index pour la table `reussite`
--
ALTER TABLE `reussite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_formations` (`id_formations`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `reussite`
--
ALTER TABLE `reussite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_formations`) REFERENCES `formations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reussite`
--
ALTER TABLE `reussite`
  ADD CONSTRAINT `reussite_ibfk_1` FOREIGN KEY (`id_formations`) REFERENCES `formations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
