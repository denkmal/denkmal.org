<?php

if (!CM_Db_Db::existsTable('denkmal_model_region')) {
    CM_Db_Db::exec('CREATE TABLE `denkmal_model_region` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `name` varchar(64) NOT NULL,
      `slug` varchar(64) NOT NULL,
      `abbreviation` varchar(16) NOT NULL,
      `locationLevel` int(11) unsigned NOT NULL,
      `locationId` int(11) unsigned NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `slug` (`slug`),
      UNIQUE KEY `abbreviation` (`abbreviation`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    ');
}
