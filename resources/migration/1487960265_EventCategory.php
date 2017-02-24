<?php

class Migration_1487960265_EventCategory implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        if (!CM_Db_Db::existsTable('denkmal_model_eventcategory')) {
            CM_Db_Db::exec('
                CREATE TABLE IF NOT EXISTS `denkmal_model_eventcategory` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `label` varchar(100) NOT NULL,
                  `color` varchar(6) NOT NULL,
                  `genreList` varchar(10000) NOT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `label` (`label`),
                  UNIQUE KEY `color` (`color`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
            ');
        }
    }
}
