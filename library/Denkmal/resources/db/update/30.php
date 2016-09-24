<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'facebookPageId')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_venue ADD COLUMN `facebookPageId` varchar(100) DEFAULT NULL AFTER twitterUsername');
}
