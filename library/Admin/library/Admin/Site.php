<?php

class Admin_Site extends Denkmal_Site {

  public function __construct() {
    parent::__construct();
    $this->_setNamespace('Admin');
  }

  public function getMenus() {
    return array(
      'main'     => new Admin_Menu_Main(),
      'weekdays' => new Admin_Menu_Weekdays(),
    );
  }
}
