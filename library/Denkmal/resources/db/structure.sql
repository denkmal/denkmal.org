SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;
DROP TABLE IF EXISTS `denkmal_event`;


CREATE TABLE `denkmal_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venueId` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `until` int(11) unsigned DEFAULT NULL,
  `description` text,
  `songId` int(11) unsigned DEFAULT NULL,
  `queued` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `star` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venueId` (`venueId`),
  KEY `from` (`from`),
  KEY `hidden` (`hidden`),
  KEY `enabled` (`enabled`),
  KEY `queued` (`queued`),
  KEY `songId` (`songId`),
  CONSTRAINT `denkmal_event__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `denkmal_event__song` FOREIGN KEY (`songId`) REFERENCES `denkmal_song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `denkmal_song`;


CREATE TABLE `denkmal_song` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `denkmal_venue`;


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
  `source` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `hidden` (`hidden`),
  KEY `enabled` (`enabled`),
  KEY `queued` (`queued`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `denkmal_venueAlias`;


CREATE TABLE `denkmal_venueAlias` (
  `name` varchar(100) NOT NULL,
  `venueId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`name`),
  KEY `venueId` (`venueId`),
  CONSTRAINT `denkmal_venueAlias__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

