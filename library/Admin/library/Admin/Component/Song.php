<?php

class Admin_Component_Song extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$song = $this->_params->getSong('song');

		$this->setTplParam('song', $song);
	}
}
