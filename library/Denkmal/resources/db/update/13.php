<?php

if (!CM_Db_Db::existsColumn('denkmal_model_message', 'user')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_model_message ADD COLUMN `user` int(11) unsigned NULL AFTER `clientId`");
}
