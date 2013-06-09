<?php

class Denkmal_Component_EventList extends Denkmal_Component_Abstract {

	public function prepare() {
		$date = $this->_params->getDate('date');

		$this->setTplParam('date', $date);
	}
}
