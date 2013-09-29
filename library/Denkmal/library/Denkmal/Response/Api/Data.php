<?php

class Denkmal_Response_Api_Data extends Denkmal_Response_Api_Abstract {

	public function __construct(CM_Request_Get $request) {
		parent::__construct($request);
	}

	protected function _process() {
		$venueListArray = array();
		/** @var Denkmal_Model_Venue $venue */
		foreach (new Denkmal_Paging_Venue_All() as $venue) {
			$venueListArray[] = $venue->toArrayApi($this->getRender());
		}

		$eventListArray = array();
		/** @var DateTime $date */
		foreach (new Denkmal_Paging_DateTime_Week() as $date) {
			/** @var Denkmal_Model_Event $event */
			foreach (new Denkmal_Paging_Event_Date($date) as $event) {
				$eventListArray[] = $event->toArrayApi($this->getRender());
			}
		}

		$messageListArray = array();
		/** @var Denkmal_Model_Message $message */
		foreach (new Denkmal_Paging_Message_All() as $message) {
			$messageListArray[] = $message->toArrayApi($this->getRender());
		}

		$dayOffset = (int) CM_Config::get()->dayOffset;

		$this->_setContent(array(
			'venues'    => $venueListArray,
			'events'    => $eventListArray,
			'messages'  => $messageListArray,
			'dayOffset' => $dayOffset,
		));
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'data';
	}
}
