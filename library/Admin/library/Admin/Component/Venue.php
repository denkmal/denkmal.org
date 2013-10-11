<?php

class Admin_Component_Venue extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$venue = $this->_params->getVenue('venue');

		$this->setTplParam('venue', $venue);
	}
}
