# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.35-0ubuntu0.12.04.2)
# Database: Together
# Generation Time: 2014-02-13 16:18:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `session_token` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table LiveData
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LiveData`;

CREATE TABLE `LiveData` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ld_key` varchar(50) DEFAULT NULL,
  `ld_value` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `LiveData` WRITE;
/*!40000 ALTER TABLE `LiveData` DISABLE KEYS */;

INSERT INTO `LiveData` (`id`, `ld_key`, `ld_value`)
VALUES
	(1,'current_game',''),
	(2,'current_game_descripton',''),
	(3,'current_game_icon',''),
	(4,'alert','');

/*!40000 ALTER TABLE `LiveData` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Payers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Payers`;

CREATE TABLE `Payers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `amount` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Polls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Polls`;

CREATE TABLE `Polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(100) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `type` varchar(11) DEFAULT NULL,
  `options` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Servers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Servers`;

CREATE TABLE `Servers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `startCmd` varchar(100) DEFAULT NULL,
  `endCmd` varchar(100) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `address` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table Votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Votes`;

CREATE TABLE `Votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voterID` varchar(20) DEFAULT NULL,
  `vote` varchar(100) DEFAULT NULL,
  `pollID` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
