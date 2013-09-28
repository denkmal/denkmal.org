<?php

class Admin_Component_EventList_DateTime extends Admin_Component_EventList_Abstract {

	public function prepare() {
		$date = $this->getParams()->getDateTime('date');
		$eventList = new Admin_Paging_Event_Date($date);

		$this->_prepareList($eventList);
	}
}
