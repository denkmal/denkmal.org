<?php

class Admin_Component_VenueMerge extends Admin_Component_Abstract {

	public function prepare() {
		$venue = $this->_params->getVenue('venue');

		$this->setTplParam('venue', $venue);
	}
}
