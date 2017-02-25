<?php

class Migration_1488036084_GenreColors implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        Denkmal_Model_EventCategory::getByLabel('e-music')->setColor(CM_Color_RGB::fromHexString('e8e2c3'));
        Denkmal_Model_EventCategory::getByLabel('blues')->setColor(CM_Color_RGB::fromHexString('cde0ef'));
        Denkmal_Model_EventCategory::getByLabel('pop')->setColor(CM_Color_RGB::fromHexString('efcdee'));
        Denkmal_Model_EventCategory::getByLabel('rock')->setColor(CM_Color_RGB::fromHexString('dadada'));
        Denkmal_Model_EventCategory::getByLabel('electronic')->setColor(CM_Color_RGB::fromHexString('efcdcd'));
        Denkmal_Model_EventCategory::getByLabel('dnb')->setColor(CM_Color_RGB::fromHexString('cdefdc'));
        Denkmal_Model_EventCategory::getByLabel('hiphop')->setColor(CM_Color_RGB::fromHexString('DEE6DD'));
        Denkmal_Model_EventCategory::getByLabel('performance')->setColor(CM_Color_RGB::fromHexString('fbe5b5'));
    }
}
