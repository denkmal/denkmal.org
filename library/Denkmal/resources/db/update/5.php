<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'email')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_venue ADD COLUMN `email` varchar(100) DEFAULT NULL');
}
