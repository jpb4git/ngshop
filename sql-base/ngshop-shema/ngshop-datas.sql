-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 11 Février 2019 à 16:28
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
-- Structure de la table `Adress`
--

CREATE TABLE `Adress` (
  `idAdress` int(11) NOT NULL,
  `Label` varchar(45) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Numero` varchar(45) NOT NULL,
  `Rue` varchar(150) NOT NULL,
  `Complement` varchar(150) NOT NULL,
  `Cp` varchar(45) NOT NULL,
  `Ville` varchar(45) NOT NULL,
  `Pays` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Adress`
--

INSERT INTO `Adress` (`idAdress`, `Label`, `Nom`, `Prenom`, `Numero`, `Rue`, `Complement`, `Cp`, `Ville`, `Pays`) VALUES
(1, 'mon adresse perso', 'FAURE', 'Julien', '5', 'des faventines', 'bat.2 ', '26000', 'valence', 'france'),
(2, 'adresse soeur', 'FAURE', 'isabelle', '18', 'des test', 'bat.3', '07130', 'cornas', 'france');

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
  `Image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Article_idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `idCommande` int(11) NOT NULL,
  `Numero` varchar(10) NOT NULL,
  `Date_de_Commande` datetime NOT NULL,
  `Adress_idAdress` int(11) NOT NULL,
  `Adress_idAdress1` int(11) NOT NULL,
  `User_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Commande_has_Article`
--

CREATE TABLE `Commande_has_Article` (
  `Commande_idCommande` int(11) NOT NULL,
  `Article_idArticle` int(11) NOT NULL,
  `Qts` int(11) DEFAULT NULL,
  `Prix` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Promo`
--

CREATE TABLE `Promo` (
  `idPromo` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Date_de_Debut` datetime DEFAULT NULL,
  `Date_de_Fin` datetime DEFAULT NULL,
  `%_Remise` decimal(2,1) DEFAULT NULL,
  `Prix_Remise` varchar(45) DEFAULT NULL,
  `Article_idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL,
  `Prenom` varchar(45) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Adress_idAdress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `Nom`, `Prenom`, `Mail`, `Password`, `Adress_idAdress`) VALUES
(1, 'FAURE', 'julien', 'jf@test.com', '123456789', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Adress`
--
ALTER TABLE `Adress`
  ADD PRIMARY KEY (`idAdress`);

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`idCategorie`),
  ADD KEY `fk_Categorie_Article_idx` (`Article_idArticle`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD UNIQUE KEY `idCommande_UNIQUE` (`idCommande`),
  ADD KEY `fk_Commande_Adress1_idx` (`Adress_idAdress`),
  ADD KEY `fk_Commande_Adress2_idx` (`Adress_idAdress1`),
  ADD KEY `fk_Commande_User1_idx` (`User_idUser`);

--
-- Index pour la table `Commande_has_Article`
--
ALTER TABLE `Commande_has_Article`
  ADD PRIMARY KEY (`Commande_idCommande`,`Article_idArticle`),
  ADD KEY `fk_Commande_has_Article_Article1_idx` (`Article_idArticle`),
  ADD KEY `fk_Commande_has_Article_Commande1_idx` (`Commande_idCommande`);

--
-- Index pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD PRIMARY KEY (`idPromo`),
  ADD KEY `fk_Promo_Article1_idx` (`Article_idArticle`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_User_Adress1_idx` (`Adress_idAdress`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Adress`
--
ALTER TABLE `Adress`
  MODIFY `idAdress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Promo`
--
ALTER TABLE `Promo`
  MODIFY `idPromo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD CONSTRAINT `fk_Categorie_Article` FOREIGN KEY (`Article_idArticle`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `fk_Commande_Adress1` FOREIGN KEY (`Adress_idAdress`) REFERENCES `Adress` (`idAdress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commande_Adress2` FOREIGN KEY (`Adress_idAdress1`) REFERENCES `Adress` (`idAdress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commande_User1` FOREIGN KEY (`User_idUser`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Commande_has_Article`
--
ALTER TABLE `Commande_has_Article`
  ADD CONSTRAINT `fk_Commande_has_Article_Article1` FOREIGN KEY (`Article_idArticle`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commande_has_Article_Commande1` FOREIGN KEY (`Commande_idCommande`) REFERENCES `Commande` (`idCommande`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD CONSTRAINT `fk_Promo_Article1` FOREIGN KEY (`Article_idArticle`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_User_Adress1` FOREIGN KEY (`Adress_idAdress`) REFERENCES `Adress` (`idAdress`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
