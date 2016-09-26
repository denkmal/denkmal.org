<?php

if (!CM_Db_Db::existsTable('denkmal_model_facebookpage')) {
    CM_Db_Db::exec('
        CREATE TABLE IF NOT EXISTS `denkmal_model_facebookpage` (
          `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
          `facebookId` VARCHAR(100) NOT NULL,
          `name` VARCHAR(500) NOT NULL,
          `failedCount` TINYINT(4) UNSIGNED NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `facebookId` (`facebookId`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}

if (CM_Db_Db::existsColumn('denkmal_model_venue', 'facebookPageId')) {
    CM_Db_Db::exec('
    ALTER TABLE `denkmal_model_venue`
      ADD COLUMN `facebookPage` INT(11) UNSIGNED DEFAULT NULL AFTER `twitterUsername`,
      ADD CONSTRAINT `denkmal_model_venue__facebookpage` FOREIGN KEY (`facebookpage`) REFERENCES `denkmal_model_facebookpage` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
      DROP COLUMN `facebookPageId`
    ');
}
