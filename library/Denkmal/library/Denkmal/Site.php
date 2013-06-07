<?php

class Denkmal_Site extends CM_Site_Abstract {

	const TYPE = 100;

	public function __construct() {
		parent::__construct();
		$this->_setNamespace('Denkmal');
	}

	public static function match(CM_Request_Abstract $request) {
		return true;
	}
}
