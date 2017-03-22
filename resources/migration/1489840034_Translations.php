<?php

class Migration_1489840034_Translations implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        $translationSetup = new CM_App_SetupScript_Translations($this->getServiceManager());
        $translationSetup->load($output);
    }
}
