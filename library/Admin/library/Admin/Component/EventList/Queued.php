<?php

class Admin_Component_EventList_Queued extends Admin_Component_EventList_Abstract {

	public function prepare() {
		$params = $this->getParams();
		$eventList = new Admin_Paging_Event_Queued();

		$this->_prepareList($eventList);
	}
}
