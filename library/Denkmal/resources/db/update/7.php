<?php

if (!CM_Db_Db::existsTable('denkmal_scraper_sourceresult')) {
    CM_Db_Db::exec('
        CREATE TABLE IF NOT EXISTS `denkmal_scraper_sourceresult` (
          `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
          `sourceType` INT(11) UNSIGNED NOT NULL,
          `created` INT(11) UNSIGNED NOT NULL,
          `eventDataCount` INT(11) UNSIGNED NOT NULL,
          `error` TEXT NULL,
          PRIMARY KEY (`id`),
          KEY `sourceType` (`sourceType`),
          KEY `created` (`created`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}
