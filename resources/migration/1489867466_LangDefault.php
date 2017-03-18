<?php

class Migration_1489867466_LangDefault implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        $de = CM_Model_Language::findByAbbreviation('de');
        $en = CM_Model_Language::findByAbbreviation('en');

        $de->setBackup(null);
        $en->setBackup($de);
    }
}
