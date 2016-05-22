<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'regionId')) {
    CM_Db_Db::exec('ALTER TABLE `denkmal_model_venue` ADD COLUMN `regionId` int(11) unsigned NOT NULL');

    CM_Db_Db::exec("UPDATE `denkmal_model_venue` SET regionId=(
      SELECT `id` from `denkmal_model_region` WHERE abbreviation = 'BSL' LIMIT 1
    ) 
    WHERE regionId=0");
}
