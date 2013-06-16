<?php

class Denkmal_Response_Api_Messages extends Denkmal_Response_Api_Abstract {

	public function __construct(CM_Request_Get $request) {
		parent::__construct($request);
	}

	protected function _process() {
		$messageList = new Denkmal_Paging_Message_All();
		$result = array();
		/** @var Denkmal_Model_Message $message */
		foreach ($messageList as $message) {
			$result[] = array(
				'id'      => $message->getId(),
				'venue'   => $message->getVenue()->getId(),
				'created' => $message->getCreated(),
				'text'    => $message->getText(),
			);
		}
		$this->_setContent($result);
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'messages';
	}
}
