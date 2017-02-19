<?php

class Migration_1487515031_EventLink implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        if (!CM_Db_Db::existsTable('denkmal_model_eventlink')) {
            CM_Db_Db::exec('
                CREATE TABLE IF NOT EXISTS `denkmal_model_eventlink` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `event` int(11) unsigned NOT NULL,
                  `label` varchar(100) NOT NULL,
                  `url` varchar(500) NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `denkmal_model_eventlink__event` FOREIGN KEY (`event`) REFERENCES `denkmal_model_event` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
            ');
        }
    }
}
