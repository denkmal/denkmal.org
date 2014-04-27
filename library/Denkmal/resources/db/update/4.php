<?php

if (!CM_Db_Db::existsTable('denkmal_model_messageimage')) {
    CM_Db_Db::exec('
    CREATE TABLE `denkmal_model_messageimage` (
      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    ');
}
