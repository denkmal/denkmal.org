<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'twitterUsername')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_venue ADD COLUMN `twitterUsername` varchar(100) DEFAULT NULL');
}
