<?php

class Denkmal_Site extends CM_Site_Abstract {

	const TYPE = 100;

	public function __construct() {
		parent::__construct();
		$this->_setNamespace('Denkmal');
	}

	/**
	 * @return CM_Menu[]
	 */
	public function getMenus() {
		return array(
			'dates' => new Denkmal_Menu_Weekdays(),
		);
	}

	public static function match(CM_Request_Abstract $request) {
		if (0 === strpos($request->getHeader('host'), 'www.denkmal.')) {
			return true;
		}
		return false;
	}
}
