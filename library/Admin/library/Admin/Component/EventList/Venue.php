<?php

class Admin_Component_EventList_Venue extends Admin_Component_EventList_Abstract {

	public function prepare() {
		$venue = $this->_params->getVenue('venue');
		$eventList = new Denkmal_Paging_Event_Venue($venue);
		$this->_prepareList($eventList);
	}
}
