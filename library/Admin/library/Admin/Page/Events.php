<?php

class Admin_Page_Events extends Admin_Page_Abstract {

	public function prepare() {
		$date = $this->_params->getDate('date')->getDateTime();

		$this->setTplParam('date', $date);
	}
}
