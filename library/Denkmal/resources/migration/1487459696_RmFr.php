<?php

class Migration_1487459696_RmFr implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        $fr = CM_Model_Language::findByAbbreviation('fr');
        if ($fr) {
            $fr->delete();
        }
    }
}
