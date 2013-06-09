<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

	public function prepare() {
		if ($this->_params->has('event') && $this->_params->has('data')) {
			throw new CM_Exception_Invalid('Can\'t pass both `event` and `data`');
		}

		$data = null;
		if ($this->_params->has('event')) {
			$event = $this->_params->getEvent('event');
			$venue = $event->getVenue();
			$data = array(
				'description' => $event->getDescription(),
				'from'        => $event->getFrom()->format('H:mm'),
				'starred'     => $event->getStarred(),

				'venue'       => $venue->getName(),
				'address'     => $venue->getAddress(),
				'url'         => $venue->getAddress(),
			);
		}
		if ($this->_params->has('data')) {
			$data = $this->_params->getArray('data');
			if (is_numeric($data['venue'])) {
				$venue = new Denkmal_Model_Venue($data['venue']);
				$data['venue'] = $venue->getName();
				$data['address'] = $venue->getAddress();
				$data['url'] = $venue->getUrl();
			}
		}
		$this->setTplParam('data', $data);
	}
}
