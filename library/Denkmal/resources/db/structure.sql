SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `denkmal_message`;
DROP TABLE IF EXISTS `denkmal_event`;
DROP TABLE IF EXISTS `denkmal_venueAlias`;
DROP TABLE IF EXISTS `denkmal_venue`;
DROP TABLE IF EXISTS `denkmal_song`;
DROP TABLE IF EXISTS `denkmal_link`;



CREATE TABLE `denkmal_song` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_venue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `queued` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `queued` (`queued`),
  KEY `enabled` (`enabled`),
  KEY `hidden` (`hidden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_venueAlias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `venueId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `venueId` (`venueId`),
  CONSTRAINT `denkmal_venueAlias__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venueId` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `until` int(11) unsigned DEFAULT NULL,
  `description` text,
	`title` varchar(100) DEFAULT NULL,
  `songId` int(11) unsigned DEFAULT NULL,
  `queued` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `starred` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venueId` (`venueId`),
  KEY `from` (`from`),
  KEY `queued` (`queued`),
  KEY `enabled` (`enabled`),
  KEY `hidden` (`hidden`),
  KEY `songId` (`songId`),
  CONSTRAINT `denkmal_event__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `denkmal_event__song` FOREIGN KEY (`songId`) REFERENCES `denkmal_song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venueId` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `text` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venueId` (`venueId`),
  KEY `created` (`created`),
  CONSTRAINT `denkmal_message__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `denkmal_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `automatic` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
