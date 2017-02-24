<?php

class Migration_1487943445_RemoveNow implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        if (CM_Db_Db::existsTable('denkmal_model_tag')) {
            CM_Db_Db::exec('DROP TABLE denkmal_model_tag');
        }
        if (CM_Db_Db::existsTable('denkmal_model_message')) {
            CM_Db_Db::exec('DROP TABLE denkmal_model_message');
        }
        if (CM_Db_Db::existsTable('denkmal_model_messageimage')) {
            CM_Db_Db::exec('DROP TABLE denkmal_model_messageimage');
        }

        CM_Db_Db::exec('DELETE FROM cm_role WHERE role=3');
    }
}
