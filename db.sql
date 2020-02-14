-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2019 at 08:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `123scandi321`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `pages` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`type_id`, `pages`, `author`, `language`) VALUES
(41, 200, 'Some Author', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `clock`
--

DROP TABLE IF EXISTS `clock`;
CREATE TABLE IF NOT EXISTS `clock` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `length` float NOT NULL,
  `weight` float NOT NULL,
  `color` varchar(255) NOT NULL,
  `batteries` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clock`
--

INSERT INTO `clock` (`type_id`, `height`, `width`, `length`, `weight`, `color`, `batteries`, `type`) VALUES
(2, 15, 15, 23, 12, 'Brown', '1xAA', 'Alarm');

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

DROP TABLE IF EXISTS `furniture`;
CREATE TABLE IF NOT EXISTS `furniture` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `length` float NOT NULL,
  `weight` float NOT NULL,
  `color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`type_id`, `height`, `width`, `length`, `weight`, `color`, `material`) VALUES
(12, 25, 25, 25, 25, 'red', 'leather');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_price` float DEFAULT NULL,
  `item_type` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `sku`, `item_name`, `item_price`, `item_type`, `type_id`) VALUES
(73, '87233298', 'Sample Clock', 99.99, 'Clock', 2),
(70, '87654355', 'Sample Lamp 2', 35.99, 'Lamp', 4),
(74, '93857432', 'Sample Chair', 399.99, 'Furniture', 12),
(71, '87633298', 'Sample Movie', 12.59, 'Movie', 2),
(67, '87654321', 'Sample Lamp', 44.99, 'Lamp', 1),
(66, '12345678', 'Sample Book', 11.99, 'Book', 41);

-- --------------------------------------------------------

--
-- Table structure for table `lamp`
--

DROP TABLE IF EXISTS `lamp`;
CREATE TABLE IF NOT EXISTS `lamp` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `volts` int(11) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `length` float NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lamp`
--

INSERT INTO `lamp` (`type_id`, `color`, `material`, `volts`, `weight`, `height`, `width`, `length`) VALUES
(1, 'Black', 'Plastic', 120, 44, 12, 34, 13),
(4, 'White', 'Plastic', 120, 44, 33, 33, 33);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `format` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `runtime` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`type_id`, `format`, `year`, `runtime`, `language`) VALUES
(2, 'blu ray', 2012, '1h53min', 'English');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
