<?php

class Admin_Component_EventList_Abstract extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	protected function _prepareList(CM_Paging_Abstract $eventList) {
		$eventList->setPage($this->_params->getPage(), $this->_params->getInt('count', 50));

		$this->setTplParam('eventList', $eventList);
	}
}
