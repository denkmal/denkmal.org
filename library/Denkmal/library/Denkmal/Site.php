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
		$menuDateData = array();
		$date = new Denkmal_Date();
		$dateInterval = new DateInterval('P1D');
		for ($i = 1; $i < 7; $i++) {
			$date = clone $date;
			$date->add($dateInterval);
			$menuDateData[] = array(
				'label'  => $date->getWeekday(),
				'page'   => 'Denkmal_Page_Events',
				'params' => array('date' => $date->__toString()),
				'class'  => 'navButton',
			);
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
