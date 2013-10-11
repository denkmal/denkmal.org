<?php

class Admin_Component_Event extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$event = $this->_params->getEvent('event');
		$venue = $event->getVenue();

		$this->setTplParam('event', $event);
		$this->setTplParam('venue', $venue);
	}
}
