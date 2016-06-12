<?php

class Admin_Site extends Denkmal_Site_Default {

    /** @var Denkmal_Model_Region|null $region */
    private $_region;

    public function __construct() {
        parent::__construct();
        $this->_setModule('Admin');
    }

    public function getMenus() {
        return array(
            'main'     => new Admin_Menu_Main(),
            'weekdays' => new Admin_Menu_Weekdays(),
        );
    }

    /**
     * @return string
     */
    public function getLoginPage() {
        return 'Admin_Page_Events';
    }

    /**
     * @param CM_Http_Response_Page $response
     */
    public function preprocessPageResponse(CM_Http_Response_Page $response) {
        parent::preprocessPageResponse($response);

        $session = $response->getRequest()->getSession();
        if ($session->has('region')) {
            $this->_region = new Denkmal_Model_Region($session->get('region'));
        }
    }

    public function hasRegion() {
        return null !== $this->_region;
    }

    public function getRegion() {
        if (null === $this->_region) {
            throw new CM_Exception('Site has not region');
        }
        return $this->_region;
    }

}
