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
		$date = new Denkmal_Date();
		$dateInterval = new DateInterval('P1D');
		$menuDateData = array();
		for ($i = 0; $i < 7; $i++) {
			$menuDateData[] = array(
				'label'  => $date->getWeekday(),
				'page'   => 'Denkmal_Page_Events',
				'params' => array('date' => $date->__toString()),
			);
			$date->add($dateInterval);
		}

		return array('dates' => new CM_Menu($menuDateData));
	}

	public static function match(CM_Request_Abstract $request) {
		if (0 === strpos($request->getHeader('host'), 'www.denkmal.')) {
			return true;
		}
		return false;
	}
}
