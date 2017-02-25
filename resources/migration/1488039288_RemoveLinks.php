<?php

class Migration_1488039288_RemoveLinks implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        if (CM_Db_Db::existsTable('denkmal_model_link')) {
            CM_Db_Db::exec('DROP TABLE denkmal_model_link');
        }
    }
}
