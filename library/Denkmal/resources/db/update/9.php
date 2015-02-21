<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'suspended')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_venue ADD COLUMN `suspended` tinyint(4) unsigned NOT NULL DEFAULT '1'");
}
