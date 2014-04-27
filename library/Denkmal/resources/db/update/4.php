<?php

if (!CM_Db_Db::existsTable('denkmal_model_messageimage')) {
    CM_Db_Db::exec('
    CREATE TABLE `denkmal_model_messageimage` (
      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}

if (!CM_Db_Db::existsColumn('denkmal_model_message', 'image')) {
    CM_Db_Db::exec('
    ALTER TABLE `denkmal_model_message`
      ADD COLUMN `image` int(11) unsigned DEFAULT NULL,
      ADD CONSTRAINT `denkmal_model_message__image` FOREIGN KEY (`image`) REFERENCES `denkmal_model_messageimage` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
    ');
}

if (!CM_Db_Db::describeColumn('denkmal_model_message', 'text')->getAllowNull()) {
    CM_Db_Db::exec('
    ALTER TABLE `denkmal_model_message`
      CHANGE COLUMN `text` `text` varchar(1000) DEFAULT NULL
    ');
}
