<?php

if (!CM_Db_Db::existsTable('denkmal_model_pushsubscription')) {
    CM_Db_Db::exec('
      CREATE TABLE IF NOT EXISTS `denkmal_model_pushsubscription` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `subscriptionId` varchar(255) NOT NULL,
        `endpoint` varchar(255) NOT NULL,
        `user` int(11) unsigned DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `user` (`user`),
        CONSTRAINT `denkmal_model_pushsubscription__user` FOREIGN KEY (`user`) REFERENCES `denkmal_model_user` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    ');
}
