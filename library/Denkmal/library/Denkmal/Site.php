<?php

class Denkmal_Site extends CM_Site_Abstract {

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
     * @return Denkmal_Suspension
     */
    public function getSuspension() {
        return new Denkmal_Suspension($this);
    }

    /**
     * @return boolean
     */
    public function getAnonymousMessagingDisabled() {
        return (bool) CM_Option::getInstance()->get('denkmal.anonymousMessagingDisabled');
    }

    /**
     * @param bool $state
     */
    public function setAnonymousMessagingDisabled($state) {
        $state = (int) $state;
        CM_Option::getInstance()->set('denkmal.anonymousMessagingDisabled', $state);
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
        $serviceManager = CM_Service_Manager::getInstance();
        return $serviceManager->get('push-client-configuration', 'Denkmal_Push_ClientConfiguration');
    }

    /**
     * @return int
     */
    public static function getDayOffset() {
        return (int) CM_Config::get()->dayOffset;
    }

    /**
     * @return DateTime
     */
    public static function getCurrentDate() {
        $date = new DateTime();
        $date->sub(new DateInterval('PT' . self::getDayOffset() . 'H'));
        $date->setTime(0, 0, 0);
        return $date;
    }
}
