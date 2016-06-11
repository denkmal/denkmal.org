<?php

if (!CM_Db_Db::existsColumn('denkmal_push_subscription', 'site')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_push_subscription ADD COLUMN `site` INT(10) UNSIGNED NOT NULL AFTER `endpoint`");
    CM_Db_Db::exec("UPDATE `denkmal_push_subscription` SET site=80");
}

if (!CM_Db_Db::existsIndex('denkmal_push_subscription', 'site')) {
    CM_Db_Db::exec('ALTER TABLE denkmal_push_subscription ADD KEY `site` (`site`)');
}
