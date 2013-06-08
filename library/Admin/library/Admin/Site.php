<?php

class Admin_Site extends CM_Site_Abstract {

	const TYPE = 101;

	public function __construct() {
		parent::__construct();
		$this->_setNamespace('Admin');
	}

	public static function match(CM_Request_Abstract $request) {
		if (0 === strpos($request->getHeader('host'), 'admin.')) {
			return true;
		}
		return false;
	}
}
