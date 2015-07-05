<?php

if (!CM_Db_Db::existsColumn('denkmal_model_venue', 'secret')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_venue ADD COLUMN `secret` tinyint(4) unsigned NOT NULL DEFAULT '0' AFTER `suspended`");
}
