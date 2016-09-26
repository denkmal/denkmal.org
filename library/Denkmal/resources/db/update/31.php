<?php

if (!CM_Db_Db::existsTable('denkmal_model_facebookpage')) {
    CM_Db_Db::exec('
        CREATE TABLE IF NOT EXISTS `denkmal_model_facebookpage` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `facebookId` varchar(100) NOT NULL,
          `name` varchar(500) NOT NULL,
          `failedCount` tinyint(4) unsigned NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `facebookId` (`facebookId`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}
