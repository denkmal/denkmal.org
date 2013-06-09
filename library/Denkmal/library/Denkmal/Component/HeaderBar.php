<?php

class Denkmal_Component_HeaderBar extends Denkmal_Component_Abstract {

	public function prepare() {
		$dateMenu = array();
		$date = new Denkmal_Date();
		$dateInterval = new DateInterval('P1D');
		for ($i = 1; $i < 7; $i++) {
			$date = clone $date;
			$date->add($dateInterval);
			$dateMenu[] = array(
				'label'  => $date->getWeekday(),
				'page'   => 'Denkmal_Page_Events',
				'params' => array('date' => $date->__toString()),
				'class'  => 'navButton',
			);
		}

		$this->setTplParam('dateMenu', $dateMenu);
	}
}
