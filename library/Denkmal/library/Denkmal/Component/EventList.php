<?php

class Denkmal_Component_EventList extends Denkmal_Component_Abstract {

	public function prepare() {
		$date = $this->getParams()->getDateTime('date');
		$events = new Denkmal_Paging_Event_Date($date, true);

		$this->setTplParam('events', $events);
	}
}
