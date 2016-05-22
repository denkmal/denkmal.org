<?php

class Denkmal_Site_Default extends CM_Site_Abstract {

    public function __construct() {
        parent::__construct();
        $this->_setModule('Denkmal');
    }

    /**
     * @return CM_Menu[]
     */
    public function getMenus() {
        return array(
            'main'  => new Denkmal_Menu_Main(),
            'dates' => new Denkmal_Menu_Weekdays(),
        );
    }

    /**
     * @return string
     */
    public function getLoginPage() {
        return 'Denkmal_Page_Now';
    }

    /**
     * @return Denkmal_Push_ClientConfiguration
     */
    public function getPushClientConfiguration() {
        /** @var Denkmal_Push_Notification_Sender $pushNotificationSender */
        $pushNotificationSender = CM_Service_Manager::getInstance()->get('push-notification-sender', 'Denkmal_Push_Notification_Sender');
        return $pushNotificationSender->getClientConfig();
    }

    /**
     * @return bool
     */
    public function hasRegion() {
        return false;
    }

    /**
     * @return Denkmal_Model_Region
     * @throws CM_Exception
     */
    public function getRegion() {
        throw new CM_Exception('Site has no region');
    }

}
