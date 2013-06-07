SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `denkmal_message`;
DROP TABLE IF EXISTS `denkmal_event`;
DROP TABLE IF EXISTS `denkmal_venueAlias`;
DROP TABLE IF EXISTS `denkmal_venue`;
DROP TABLE IF EXISTS `denkmal_song`;



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
  `status` tinyint(4) unsigned NOT NULL,
  `source` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_venueAlias` (
  `name` varchar(100) NOT NULL,
  `venueId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`name`),
  KEY `venueId` (`venueId`),
  CONSTRAINT `denkmal_venueAlias__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venueId` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `until` int(11) unsigned DEFAULT NULL,
  `description` text,
  `songId` int(11) unsigned DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL,
  `star` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venueId` (`venueId`),
  KEY `from` (`from`),
  KEY `status` (`status`),
  KEY `songId` (`songId`),
  CONSTRAINT `denkmal_event__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `denkmal_event__song` FOREIGN KEY (`songId`) REFERENCES `denkmal_song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `denkmal_message` (
  `id` int(11) unsigned NOT NULL,
  `venueId` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `text` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venueId` (`venueId`),
  KEY `created` (`created`),
  CONSTRAINT `denkmal_message__venue` FOREIGN KEY (`venueId`) REFERENCES `denkmal_venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
