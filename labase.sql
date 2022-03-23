-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: mysql-allofastfood.alwaysdata.net
-- Generation Time: Jun 25, 2017 at 10:13 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allofastfood_bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `acheter`
--

CREATE TABLE IF NOT EXISTS `acheter` (
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  PRIMARY KEY (`idClient`,`idProduit`),
  KEY `FK_acheter_idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acheter`
--

INSERT INTO `acheter` (`idClient`, `idProduit`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(3) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `tel`, `cp`, `ville`) VALUES
(1, 'nam', 'truong', 'nam@gmail.com', '123', '16 rue de paris', '0765844521', '87000', 'limoges'),
(2, 'Edwina', 'serine', 'edw@gmail.com', '123', '12 rue de lyon', '0674568751', '59160', 'Lyon'),
(3, 'kamar', 'elie', 'kamar@gmail.com', '123', '10 rue de lille', '0688452564', '75007', 'Paris'),
(4, 'TRUONG', 'Nam', 'truong@hotmail.fr', '123', '116 rue Petit', '0673087468', '75019', 'Paris'),
(5, 'Dos Santos', 'Nicolas', 'nicolas@hotmail.com', '123', '11 rue Petit', '0632154698', '75019', 'Paris'),
(6, 'Nguyen', 'Tuan Anh', 'ng@hotmail.fr', '123', '7 boulevard du général leclerc', '0645789546', '92340', 'Bourg La Reine'),
(66, 'test', 'test', 'test@hotmail.com', '123', '11ruepetit', '0673054765', '75019', 'Paris');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idcommande` int(5) NOT NULL AUTO_INCREMENT,
  `datecmde` date DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `etat` varchar(30) DEFAULT NULL,
  `idprofil` int(5) NOT NULL,
  PRIMARY KEY (`idcommande`),
  KEY `idprofil` (`idprofil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`idcommande`, `datecmde`, `prix`, `etat`, `idprofil`) VALUES
(1, '2017-04-06', 12, 'en cours', 1);


--
-- Stand-in structure for view `lescommandes`
--
CREATE TABLE IF NOT EXISTS `lescommandes` (
`idcommande` int(5)
,`datecmde` date
,`prix` float
,`etat` varchar(30)
,`mail` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prix` float NOT NULL,
  `categorie` varchar(25) NOT NULL,
  `stock` int(5) DEFAULT NULL,
  PRIMARY KEY (`idProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom`, `prix`, `categorie`, `stock`) VALUES
(1, 'Hot Wings', 14, 'Pièce de Poulet', 10),
(2, 'Box Master Bacon', 7.4, 'Sandwichs', 10),
(3, 'Twister', 6.6, 'Sandwichs', 10),
(4, 'Twister', 6.6, 'Sandwichs', 10),
(5, 'Big Mac Best Of', 7.2, 'Sandwichs', 10),
(6, 'Royal Cheese', 7.3, 'Sandwichs', 10),
(7, 'Dinde et Jambon', 5.9, 'Sandwichs', 10),
(8, 'Long Chicken', 2.89,'Sandwichs', 10);

-- --------------------------------------------------------

--
-- Structure for view `lescommandes`
--
DROP TABLE IF EXISTS `lescommandes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`135552`@`%` SQL SECURITY DEFINER VIEW `lescommandes` AS (select `commande`.`idcommande` AS `idcommande`,`commande`.`datecmde` AS `datecmde`,`commande`.`prix` AS `prix`,`commande`.`etat` AS `etat`,`client`.`mail` AS `mail` from (`commande` join `client`) where (`commande`.`idprofil` = `client`.`idClient`));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `FK_acheter_idClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_acheter_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`idprofil`);

