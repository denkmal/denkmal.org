<?php

class Denkmal_App_Settings implements CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function __construct() {
        $this->setServiceManager(CM_Service_Manager::getInstance());
    }

    /**
     * @return int
     */
    public function getDayOffset() {
        return 6;
    }

    /**
     * @return DateTime
     */
    public function getCurrentDate() {
        $date = new DateTime();
        $date->sub(new DateInterval('PT' . self::getDayOffset() . 'H'));
        $date->setTime(0, 0, 0);
        return $date;
    }

}

