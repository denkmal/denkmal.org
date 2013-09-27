<?php

class Denkmal_Page_Events extends Denkmal_Page_Abstract {

	public function prepare() {

		for ($i = 0; $i <= 6; $i++) {
			$date = $this->_params->getDate('date')->getDateTime();
			$week[] = $date->add(new DateInterval('P' . $i . 'D'));
		}

		$this->setTplParam('week', $week);
	}
}
