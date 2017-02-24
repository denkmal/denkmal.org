<?php

class Migration_1487949490_EventGenres implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        if (!CM_Db_Db::existsColumn('denkmal_model_event', 'genres')) {
            CM_Db_Db::exec('ALTER TABLE denkmal_model_event ADD COLUMN `genres` text DEFAULT NULL AFTER `description`');
        }
    }
}
