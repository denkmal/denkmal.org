<?php

if (!CM_Db_Db::existsTable('denkmal_model_userinvite')) {
    CM_Db_Db::exec("
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
    ");
}
