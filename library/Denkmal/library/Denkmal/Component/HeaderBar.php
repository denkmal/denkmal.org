<?php

class Denkmal_Component_HeaderBar extends Denkmal_Component_Abstract {

	public function prepare() {
		$date = new Denkmal_Date();
		$dateInterval = new DateInterval('P1D');
		$dateList = array($date);
		for ($i = 1; $i < 7; $i++) {
			$date = clone $date;
			$date->add($dateInterval);
			$dateList[] = $date;
		}

		$this->setTplParam('dateList', $dateList);
	}
}
