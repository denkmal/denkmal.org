<?php

class Denkmal_Response_Api_Data extends Denkmal_Response_Api_Abstract {

	public function __construct(CM_Request_Get $request) {
		parent::__construct($request);
	}

	protected function _process() {
		$venueListArray = array();
		$venueList = new Denkmal_Paging_Venue_All();
		/** @var Denkmal_Model_Venue $venue */
		foreach ($venueList as $venue) {
			$venueListArray[] = $venue->toArrayApi();
		}

		$eventListArray = array();
		$eventList = new Denkmal_Paging_Event_Date(new DateTime(), true);
		/** @var Denkmal_Model_Event $event */
		foreach ($eventList as $event) {
			$eventListArray[] = $event->toArrayApi($this->getRender());
		}

		$messageListArray = array();
		$messageList = new Denkmal_Paging_Message_All();
		/** @var Denkmal_Model_Message $message */
		foreach ($messageList as $message) {
			$messageListArray[] = $message->toArrayApi();
		}

		$this->_setContent(array('venues' => $venueListArray, 'events' => $eventListArray, 'messages' => $messageListArray));
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'data';
	}
}
