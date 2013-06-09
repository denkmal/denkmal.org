<?php

class Admin_Site extends Denkmal_Site {

	const TYPE = 101;

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

	public static function match(CM_Request_Abstract $request) {
		if (0 === strpos($request->getHeader('host'), 'admin.')) {
			return true;
		}
		return false;
	}
}
