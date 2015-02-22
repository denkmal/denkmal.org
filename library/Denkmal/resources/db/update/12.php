<?php

if (!CM_Db_Db::existsTable('denkmal_model_tag')) {
    CM_Db_Db::exec("
    CREATE TABLE IF NOT EXISTS `denkmal_model_tag` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `label` varchar(20) NOT NULL,
      `active` tinyint(4) unsigned NOT NULL DEFAULT '1',
      PRIMARY KEY (`id`),
      UNIQUE KEY `label` (`label`),
      KEY `active` (`active`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ");
}

if (!CM_Db_Db::existsTable('denkmal_model_tag_model')) {
    CM_Db_Db::exec("
    CREATE TABLE IF NOT EXISTS `denkmal_model_tag_model` (
      `tagId` int(11) unsigned NOT NULL,
      `modelType` int(11) unsigned NOT NULL,
      `modelId` int(11) unsigned NOT NULL,
      PRIMARY KEY (`modelType`, `modelId`, `tagId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ");
}
