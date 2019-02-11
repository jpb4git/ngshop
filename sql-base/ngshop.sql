-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 11 Février 2019 à 22:04
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
  `Pays` varchar(45) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Adress`
--

INSERT INTO `Adress` (`idAdress`, `Label`, `Nom`, `Prenom`, `Numero`, `Rue`, `Complement`, `Cp`, `Ville`, `Pays`, `User_id`) VALUES
(3, 'adresse maison ', 'FAURE', 'JULIEN', '6', 'RUE DES SAULES', '', '26000', 'VALENCE', 'FRANCE', 1),
(4, 'ADRESSE  PAPA', 'FAURE', 'MAURICE', '52', 'BL DES ANCIENS', '10 ARR', '75000', 'PARIS', 'FRANCE', 1),
(5, 'adresse perso', 'alpha', 'raoul', '47', 'rue des fleurs', '', '38185', 'GRENOBLE', 'FRANCE', 2),
(6, 'adresse memo', 'laventin', 'sonia', '78', 'av. des pins parasols', '', '75000', 'PARIS', 'FRANCE', 3);

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

INSERT INTO `Article` (`idArticle`, `Nom`, `Descripion`, `Poids`, `Prix`, `Stock`, `Image`, `Categorie_id`) VALUES
(1, 'App shield power !', 'une application qui vous protèges', '1.00', '10.00', 50, 'assets/icon-shield-orange.svg', 1),
(2, 'App hub Green', 'Une application qui fait pousser vos plantes', '10.00', '25.00', 50, 'assets/icon-hub-green.svg', 1),
(3, 'App hub blue', 'Une application qui est bleu', '2.50', '52.00', 40, 'assets/icon-hub-blue.svg', 1),
(4, 'App Gps gLue', 'une application qui pointe le nord', '40.00', '57.00', 50, 'assets/icon-direction-blue.svg', 1),
(5, 'App yellow Rise', 'App qui fait se lever le soleil ! ', '2.00', '27.00', 0, 'assets/icon-hub-yellow.svg', 2),
(6, 'App recharger', 'app qui recharge  ... des Apps', '5.00', '15.00', 0, 'assets/avatar1.png', 1),
(7, 'App american', 'app qui se connecte à votre banque', '2.00', '13.50', 85, 'assets/custom4.svg', 2),
(8, 'Urban qhit', 'App qui fait le ménage à ta place', '0.51', '178.00', 1, 'assets/custom2.svg', 2),
(15, 'App direction', 'App qui donne la direction', '0.45', '14.50', 100, 'assets/icon-load-Balancing-green.svg', 1),
(16, 'App Box', 'app qui lie une Boite en carton', '0.50', '14.70', 0, 'assets/icon-Microservices-green.svg', 2),
(17, 'App secure wallet', 'app qui sécurise votre wallet bitcoin', '0.75', '40.00', 18, 'assets/icon-NGINX-WAF-1.svg', 1),
(18, 'App Timer', 'App qui donne l\'heure', '1.00', '10.99', 15, 'assets/icon-Web-and-Mobile-Applications-green.svg', 2),
(19, 'App Who is', 'app qui vous dit qui vous êtes ...', '0.75', '19.99', 178, 'assets/notFound.svg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL,
  `Nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Categorie`
--

INSERT INTO `Categorie` (`idCategorie`, `Nom`) VALUES
(1, 'SECU'),
(2, 'INF0RMATIQUE'),
(3, 'ELECTRONIQUE'),
(4, 'CONNECTIQUE'),
(5, 'GAME'),
(6, 'GESTION'),
(7, 'NO APPLE'),
(8, 'MUSIQUE');

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `idCommande` int(11) NOT NULL,
  `commande_num` varchar(10) NOT NULL,
  `Date_de_Commande` datetime NOT NULL,
  `Adress_id_livraison` int(11) NOT NULL,
  `Adress_id_facturation` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Commande`
--

INSERT INTO `Commande` (`idCommande`, `commande_num`, `Date_de_Commande`, `Adress_id_livraison`, `Adress_id_facturation`, `User_id`) VALUES
(1, 'ED45SR15FR', '2019-02-11 13:30:00', 3, 4, 1),
(2, 'S4RE5SD4ED', '2019-02-09 08:00:00', 6, 6, 3),
(3, '4Y789YU5U4', '2019-02-11 17:00:00', 5, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_cmd`
--

CREATE TABLE `ligne_cmd` (
  `Article_id` int(11) NOT NULL,
  `Commande_id` int(11) NOT NULL,
  `ligne_cmd_Qts` int(11) DEFAULT NULL,
  `ligne_cmd_prix` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligne_cmd`
--

INSERT INTO `ligne_cmd` (`Article_id`, `Commande_id`, `ligne_cmd_Qts`, `ligne_cmd_prix`) VALUES
(1, 1, 5, '10.00'),
(8, 2, 1, '178.00'),
(15, 2, 3, '14.50'),
(19, 3, 3, '19.99');

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
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Promo`
--

INSERT INTO `Promo` (`idPromo`, `Nom`, `Date_de_Debut`, `Date_de_Fin`, `%_Remise`, `Prix_Remise`, `idArticle`) VALUES
(1, 'BLACK FRIDAY', '2019-02-21 00:00:00', '2019-02-28 00:00:00', '5.0', NULL, 3);

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
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`idUser`, `Nom`, `Prenom`, `Mail`, `Password`, `pseudo`) VALUES
(1, 'FAURE', 'JULIEN', 'jf@mail.com', '123456789', 'nautique'),
(2, 'ALF', 'marie', 'am@mail.com', '123456789', 'marie666'),
(3, 'TIBAULT', 'KEVIN', 'tk@mail.com', '123456789', 'elfique5'),
(4, 'foster', 'kathy', 'jf@mail.com', '123456789', 'nautique'),
(5, 'Bridden', 'Merlina', 'mbridden0@ocn.ne.jp', 'rr6UGke60K', 'mbridden0'),
(6, 'Gurney', 'Jammie', 'jgurney1@indiegogo.com', 'g9tZF45vRy', 'jgurney1'),
(7, 'Elayne', 'Pierri', 'epierri2@jigsy.com', 'RjE32YV', 'epierri2'),
(8, 'Siemianowicz', 'Alessandro', 'asiemianowicz3@tripod.com', 'Prk5bgu5Rt0', 'asiemianowicz3'),
(9, 'Mei', 'Trippitt', 'mtrippittt@bizjournals.com', 'uuqMVZ1qgWeY', 'mtrippittt'),
(10, 'Deeyn', 'Hubane', 'dhubaneu@weather.com', 'nbbtBCEa', 'dhubaneu'),
(11, 'Erena', 'Tanton', 'etantonv@cnbc.com', 'ZJz1XZnf7', 'etantonv'),
(12, 'Maxine', 'Oxbie', 'moxbiew@pcworld.com', 'llpkkmzi1nD', 'moxbiew'),
(13, 'Charmaine', 'Fareweather', 'cfareweatherx@tumblr.com', 'NjVSq27bkC5Y', 'cfareweatherx'),
(14, 'Eamon', 'Lathwood', 'elathwoody@cdc.gov', '10qUqUBn6oT', 'elathwoody');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Adress`
--
ALTER TABLE `Adress`
  ADD PRIMARY KEY (`idAdress`),
  ADD KEY `fk_Adress_User1_idx` (`User_id`);

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `fk_Article_Categorie1_idx` (`Categorie_id`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD UNIQUE KEY `Numero_UNIQUE` (`commande_num`),
  ADD KEY `fk_Commande_Adress1_idx` (`Adress_id_livraison`),
  ADD KEY `fk_Commande_Adress2_idx` (`Adress_id_facturation`),
  ADD KEY `fk_Commande_User1_idx` (`User_id`);

--
-- Index pour la table `ligne_cmd`
--
ALTER TABLE `ligne_cmd`
  ADD PRIMARY KEY (`Article_id`,`Commande_id`),
  ADD KEY `fk_Article_has_Commande_Commande1_idx` (`Commande_id`),
  ADD KEY `fk_Article_has_Commande_Article1_idx` (`Article_id`);

--
-- Index pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD PRIMARY KEY (`idPromo`),
  ADD KEY `fk_Promo_Article1_idx` (`idArticle`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Adress`
--
ALTER TABLE `Adress`
  MODIFY `idAdress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Promo`
--
ALTER TABLE `Promo`
  MODIFY `idPromo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Adress`
--
ALTER TABLE `Adress`
  ADD CONSTRAINT `fk_Adress_User1` FOREIGN KEY (`User_id`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `fk_Article_Categorie1` FOREIGN KEY (`Categorie_id`) REFERENCES `Categorie` (`idCategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `fk_Commande_Adress1` FOREIGN KEY (`Adress_id_livraison`) REFERENCES `Adress` (`idAdress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commande_Adress2` FOREIGN KEY (`Adress_id_facturation`) REFERENCES `Adress` (`idAdress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commande_User1` FOREIGN KEY (`User_id`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ligne_cmd`
--
ALTER TABLE `ligne_cmd`
  ADD CONSTRAINT `fk_Article_has_Commande_Article1` FOREIGN KEY (`Article_id`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Article_has_Commande_Commande1` FOREIGN KEY (`Commande_id`) REFERENCES `Commande` (`idCommande`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Promo`
--
ALTER TABLE `Promo`
  ADD CONSTRAINT `fk_Promo_Article1` FOREIGN KEY (`idArticle`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
