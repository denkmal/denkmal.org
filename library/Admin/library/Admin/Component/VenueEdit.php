<?php

class Admin_Component_VenueEdit extends Admin_Component_Abstract {

	public function prepare() {
		$venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : null;

		$this->setTplParam('venue', $venue);
	}
}
