<?php

class Admin_Component_Filter_Search extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$urlPage = $this->_params->getString('urlPage');
		$searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

		$this->setTplParam('urlPage', $urlPage);
		$this->setTplParam('searchTerm', $searchTerm);
	}
}
