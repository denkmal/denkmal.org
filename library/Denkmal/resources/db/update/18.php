<?php

if (!CM_Db_Db::existsTable('denkmal_push_subscription')) {
    CM_Db_Db::exec('
      CREATE TABLE IF NOT EXISTS `denkmal_push_subscription` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `subscriptionId` varchar(255) NOT NULL,
        `endpoint` varchar(255) NOT NULL,
        `updated` int(11) unsigned NOT NULL,
        `user` int(11) unsigned DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `user` (`user`),
        UNIQUE KEY `subscriptionId-endpoint` (`subscriptionId`, `endpoint`),
        CONSTRAINT `denkmal_push_subscription__user` FOREIGN KEY (`user`) REFERENCES `denkmal_model_user` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    ');
}

if (!CM_Db_Db::existsTable('denkmal_push_notification_messagememo')) {
    CM_Db_Db::exec('
        CREATE TABLE IF NOT EXISTS `denkmal_push_notification_messagememo` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `subscription` int(11) unsigned NOT NULL,
          `created` int(11) unsigned NOT NULL,
          `expires` int(11) unsigned NOT NULL,
          `data` text,
          PRIMARY KEY (`id`),
          KEY `subscription` (`subscription`),
          CONSTRAINT `denkmal_push_messagememo__subscription` FOREIGN KEY (`subscription`) REFERENCES `denkmal_push_subscription` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}

