<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

	public function prepare() {
		if ($this->_params->has('event') && $this->_params->has('data')) {
			throw new CM_Exception_Invalid('Can\'t pass both `event` and `data`');
		}
		if ($this->_params->has('event')) {
			$event = $this->_params->getEvent('event');
			$venue = $event->getVenue();
			$data = array(
				'description' => $event->getDescription(),
				'from' => $event->getFrom(),
				'until' => $event->getUntil(),
				'starred' => $event->getStarred(),

				'venue' => $venue->getName(),
				'address' => $venue->getAddress(),
				'url' => $venue->getAddress(),
			);
		} else {
			$data = $this->_params->getArray('data');
		}
		$this->setTplParam('data', $data);
	}
}
