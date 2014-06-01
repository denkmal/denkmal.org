<?php

if (!CM_Db_Db::existsColumn('denkmal_model_message', 'clientId')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_model_message ADD COLUMN `clientId` varchar(100) NOT NULL');
}
