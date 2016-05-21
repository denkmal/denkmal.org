<?php

class Admin_Site extends Denkmal_Site_Default {

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
}
