<?php

class Denkmal_Page_Events extends Denkmal_Page_Abstract {

	public function prepare() {
		$date = $this->_params->getDate('date')->getDateTime();

		$this->setTplParam('date', $date);
	}
}
