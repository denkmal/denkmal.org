<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'region')) {
    CM_Db_Db::exec('ALTER TABLE `denkmal_model_venue` ADD COLUMN `region` int(11) unsigned NOT NULL');

    CM_Db_Db::exec("UPDATE `denkmal_model_venue` SET region=(
      SELECT `id` from `denkmal_model_region` WHERE abbreviation = 'BSL' LIMIT 1
    ) 
    WHERE region=0");
}
