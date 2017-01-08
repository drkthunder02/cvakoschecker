/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Christopher Mancuso
 * Created: Dec 23, 2016
 * Project: Eve Rental Payment Tracker
 */

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `RentalTracker`
--

-- --------------------------------------------------------

--
-- Table for `users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE IF NOT EXISTS `Pilot` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `Name` varchar(50) NOT NULL,
    `Corp` varchar(50) NOT NULL,
    `Alliance` varchar(50) DEFAULT NULL,
    `KOS` tinyint(1),
    PRIMARY KEY(`id`),
    UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Corporation` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `Name` varchar(50) NOT NULL,
    `Alliance` varchar(50) NOT NULL,
    `KOS` tinyint(1),
    PRIMARY KEY(`id`),
    UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Alliance` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `Name` varchar(50) NOT NULL,
    `KOS` tinyint(1),
    PRIMARY KEY(`id`),
    UNIQUE KEY `id` (`id`)    
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `UpdateList` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `Name` varchar(50) NOT NULL,
    `lastUpdate` int(10) NOT NULL
    PRIMARY KEY(`id`),
    UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
