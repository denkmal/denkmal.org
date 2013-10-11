<?php

class Admin_Component_Link extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$link = $this->_params->getLink('link');

		$this->setTplParam('link', $link);
	}
}
