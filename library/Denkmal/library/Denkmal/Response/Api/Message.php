<?php

class Denkmal_Response_Api_Message extends Denkmal_Response_Api_Abstract {

	public function __construct(CM_Request_Post $request) {
		$request->setBodyEncoding(CM_Request_Post::ENCODING_FORM);
		parent::__construct($request);
	}

	protected function _process() {
		$venue = $this->_params->getVenue('venue');
		$text = $this->_params->getString('text');

		Denkmal_Model_Message::create(array('venue' => $venue, 'text' => $text));
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'message';
	}
}
