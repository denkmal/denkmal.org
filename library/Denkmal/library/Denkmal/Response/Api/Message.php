<?php

class Denkmal_Response_Api_Message extends Denkmal_Response_Api_Abstract {

	public function __construct(CM_Request_Post $request) {
		$request->setBodyEncoding(CM_Request_Post::ENCODING_FORM);
		parent::__construct($request);
	}

	protected function _process() {
		$hashToken = self::_getConfig()->hashToken;
		$hashAlgorithm = self::_getConfig()->hashAlgorithm;

		$venue = $this->_params->getVenue('venue');
		$text = $this->_params->getString('text');
		$clientHash = $this->_params->getString('hash');

		$serverHash = hash($hashAlgorithm, $hashToken . $text);
		if ($serverHash != $clientHash) {
			throw new CM_Exception_NotAllowed('Not authorised access.');
		}

		$message = Denkmal_Model_Message::create($venue, $text);
		$response = $message->toArrayApi($this->getRender());

		$this->_setContent($response);
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'message';
	}
}
