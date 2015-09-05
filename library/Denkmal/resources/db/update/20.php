<?php

CM_Db_Db::delete('denkmal_push_notification_message');
CM_Db_Db::delete('denkmal_push_subscription');

if (CM_Db_Db::existsIndex('denkmal_push_subscription', 'subscriptionId-endpoint')) {
    CM_Db_Db::exec("DROP INDEX `subscriptionId-endpoint` ON denkmal_push_subscription;");
    CM_Db_Db::exec("CREATE UNIQUE INDEX `endpoint` ON denkmal_push_subscription (endpoint);");
}


if (CM_Db_Db::existsColumn('denkmal_push_subscription', 'subscriptionId')) {
    CM_Db_Db::exec("ALTER TABLE denkmal_push_subscription DROP COLUMN `subscriptionId`;");
}
