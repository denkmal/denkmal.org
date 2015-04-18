SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;

DROP TABLE IF EXISTS `denkmal_model_message`;
DROP TABLE IF EXISTS `denkmal_model_messageimage`;
DROP TABLE IF EXISTS `denkmal_model_event`;
DROP TABLE IF EXISTS `denkmal_model_venuealias`;
DROP TABLE IF EXISTS `denkmal_model_venue`;
DROP TABLE IF EXISTS `denkmal_model_song`;
DROP TABLE IF EXISTS `denkmal_model_link`;
DROP TABLE IF EXISTS `denkmal_model_user`;
DROP TABLE IF EXISTS `denkmal_model_userinvite`;
DROP TABLE IF EXISTS `denkmal_scraper_sourceresult`;
DROP TABLE IF EXISTS `denkmal_model_tag`;
DROP TABLE IF EXISTS `denkmal_model_tag_model`;
DROP TABLE IF EXISTS `denkmal_push_subscription`;



CREATE TABLE `denkmal_model_song` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `denkmal_model_venue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `queued` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `ignore` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `suspended` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `twitterUsername` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `queued` (`queued`),
  KEY `ignore` (`ignore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `denkmal_model_venuealias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `venue` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `venue` (`venue`),
  CONSTRAINT `denkmal_model_venuealias__venue` FOREIGN KEY (`venue`) REFERENCES `denkmal_model_venue` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `denkmal_model_event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venue` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `until` int(11) unsigned DEFAULT NULL,
  `description` text,
  `song` int(11) unsigned DEFAULT NULL,
  `queued` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `starred` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venue` (`venue`),
  KEY `from` (`from`),
  KEY `queued` (`queued`),
  KEY `enabled` (`enabled`),
  KEY `hidden` (`hidden`),
  KEY `song` (`song`),
  CONSTRAINT `denkmal_model_event__venue` FOREIGN KEY (`venue`) REFERENCES `denkmal_model_venue` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `denkmal_model_event__song` FOREIGN KEY (`song`) REFERENCES `denkmal_model_song` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `denkmal_model_messageimage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `denkmal_model_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `venue` int(11) unsigned NOT NULL,
  `clientId` varchar(100) NOT NULL,
  `user` int(11) unsigned NULL,
  `created` int(11) unsigned NOT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `image` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venue` (`venue`),
  KEY `created` (`created`),
  CONSTRAINT `denkmal_model_message__venue` FOREIGN KEY (`venue`) REFERENCES `denkmal_model_venue` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `denkmal_model_message__image` FOREIGN KEY (`image`) REFERENCES `denkmal_model_messageimage` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_model_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `automatic` tinyint(4) unsigned NOT NULL,
  `failedCount` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_model_user` (
  `userId` int(11) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` char(64) NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_model_userinvite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inviter` int(11) unsigned NOT NULL,
  `key` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `expires` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expires` (`expires`),
  KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_scraper_sourceresult` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sourceType` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `eventDataCount` int(11) unsigned NOT NULL,
  `error` text NULL,
  PRIMARY KEY (`id`),
  KEY `sourceType` (`sourceType`),
  KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_model_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL,
  `active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_model_tag_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagId` int(11) unsigned NOT NULL,
  `modelType` int(11) unsigned NOT NULL,
  `modelId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modelType-modelId-tagId` (`modelType`, `modelId`, `tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `denkmal_push_subscription` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subscriptionId` varchar(255) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `user` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  UNIQUE KEY `subscriptionId-endpoint` (`subscriptionId`, `endpoint`),
  CONSTRAINT `denkmal_push_subscription__user` FOREIGN KEY (`user`) REFERENCES `denkmal_model_user` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
