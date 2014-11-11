-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2014 at 09:06 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ia_crud`
--


-- --------------------------------------------------------

--
-- Table structure for table `Contacts`
--
DROP TABLE IF EXISTS `Contacts`;
CREATE TABLE IF NOT EXISTS `Contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contacts`
--



INSERT INTO `Contacts` (`id`, `firstName`, `lastName`, `address`, `email`, `created`, `modified`) VALUES
(7, 'Ivan', 'Atanasov', 'bul. "Al. Stamboliiski" 35', 'i.atanasov77@gmail.com', '2014-10-31 15:06:00', '2014-10-31 15:06:00'),
(12, 'Методи', 'Кирилов', NULL, 'mkirilov@abv.bg', '2014-11-03 07:39:04', '2014-11-03 07:39:04'),
(19, 'Антон', 'Господинов', NULL, 'agospodinov@abv.bg', '2014-11-03 08:08:32', '2014-11-03 08:08:32'),
(20, 'Деян', 'Христов', NULL, 'dhristov@gmail.com', '2014-11-03 08:20:48', '2014-11-03 08:20:48');


-- --------------------------------------------------------

--
-- Table structure for table `ContactPhones`
--
DROP TABLE IF EXISTS `ContactPhones`;
CREATE TABLE IF NOT EXISTS `ContactPhones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(32)  NOT NULL,
  `description` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `contactsId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (contactsId) REFERENCES Contacts(id) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ContactPhones`
--

INSERT INTO `ContactPhones` (`id`, `phoneNumber`, `description`, `created`, `modified`, `contactsId`) VALUES
(1, '00000000', 'home', '2014-10-31 14:17:48', '2014-10-31 14:17:48', 0),
(2, '0878 865 515', 'Mobile', '2014-10-31 15:06:00', '2014-10-31 15:06:00', 7),
(4, '078 000000', 'Mobile', '2014-11-03 07:40:38', '2014-11-03 07:40:38', 12),
(11, '0878 000000', 'Mobile', '2014-11-03 08:09:04', '2014-11-03 08:09:04', 19),
(12, '032 000000', 'Home', '2014-11-03 08:21:28', '2014-11-03 08:21:28', 20);

SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
