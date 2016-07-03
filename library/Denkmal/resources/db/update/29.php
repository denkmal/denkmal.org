<?php

if (!CM_Db_Db::existsColumn('denkmal_model_region', 'suspensionUntil')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_region ADD COLUMN `suspensionUntil` int(11) unsigned NULL");
}
