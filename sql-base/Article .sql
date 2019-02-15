-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 11 Février 2019 à 18:36
-- Version du serveur :  5.7.25-0ubuntu0.18.10.2
-- Version de PHP :  7.2.10-0ubuntu1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ngshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `idArticle` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Descripion` varchar(45) DEFAULT NULL,
  `Poids` decimal(5,2) DEFAULT NULL,
  `Prix` decimal(5,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Article`
--

INSERT INTO `Article` (id_Article, `Nom`, `Descripion`, `Poids`, `Prix`, `Stock`, Urlimage, `Categorie_id`) VALUES
(1, 'App shield power !', 'une application qui vous protèges', '1.00', '599.00', 50, 'assets/icon-shield-orange.svg', 1),
(2, 'App hub Green', 'Une application qui fait pousser vos plantes', '10.00', '25.00', 50, 'assets/icon-hub-green.svg', 1),
(3, 'App hub blue', 'Une application qui est bleu', '2.50', '52.00', 40, 'assets/icon-hub-blue.svg', 1),
(4, 'App Gps gLue', 'une application qui pointe le nord', '40.00', '57.00', 50, 'assets/icon-direction-blue.svg', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (id_Article),
  ADD KEY `fk_Article_Categorie1_idx` (`Categorie_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `fk_Article_Categorie1` FOREIGN KEY (`Categorie_id`) REFERENCES `Categorie` (id_Categorie) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
