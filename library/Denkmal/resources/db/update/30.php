<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'facebookPageId')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_venue ADD COLUMN `facebookPageId` VARCHAR(100) DEFAULT NULL AFTER twitterUsername');
}

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'facebookAccessToken')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_region ADD COLUMN `facebookAccessToken` VARCHAR(1000) NULL AFTER facebookAccount');
}
