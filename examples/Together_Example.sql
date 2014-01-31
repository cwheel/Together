DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `session_token` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Polls`;

CREATE TABLE `Polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(100) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `type` varchar(11) DEFAULT NULL,
  `options` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Servers`;

CREATE TABLE `Servers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(11) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `startCmd` varchar(100) DEFAULT NULL,
  `endCmd` varchar(100) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Votes`;

CREATE TABLE `Votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voterID` varchar(20) DEFAULT NULL,
  `vote` varchar(100) DEFAULT NULL,
  `pollID` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;