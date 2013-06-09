<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

	public function prepare() {
		$event = $this->_params->getArray('event');

		$this->setTplParam('event', $event);
	}
}
