/**
 * Author:  Christopher Mancuso
 * Created: January 2017
 * Project: W4RP KOS Checker
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

--
-- Table structure for Pilot entities
--

CREATE TABLE IF NOT EXISTS `Pilot` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `eveid` varchar(20) NOT NULL,
    `label` varchar(255) NOT NULL,
    `icon` varchar(255),
    `kos` boolean,
    `lastUpdate` int(20) NOT NULL,
    PRIMARY KEY (`eveid`)
    UNIQUE KEY `eveid` (`eveid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for Corporation entities
--

CREATE TABLE IF NOT EXISTS `Corporation` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `eveid` varchar(20) NOT NULL,
    `label` varchar(255) NOT NULL,
    `icon` varchar(255),
    `kos` boolean,
    `ticker` varchar(6) NOT NULL,
    `npc` boolean,
    `lastUpdate` int(20) NOT NULL,
    PRIMARY KEY (`eveid`),
    UNIQUE KEY `eveid` (`eveid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for Alliance entities
--

CREATE TABLE IF NOT EXISTS `Alliance` ( 
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `eveid` varchar(20) NOT NULL,
    `label` varchar(255) NOT NULL,
    `icon` varchar(255),
    `kos` boolean,
    `ticker` varchar(6) NOT NULL,
    `lastUpdate` int(20) NOT NULL,
    PRIMARY KEY (`eveid`),
    UNIQUE KEY `eveid` (`eveid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

