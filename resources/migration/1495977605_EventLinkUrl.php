<?php

class Migration_1495977605_EventLinkUrl implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        CM_Model_LanguageKey::deleteByName('Venue Website');
    }
}
