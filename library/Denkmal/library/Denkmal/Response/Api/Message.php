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

		$response = array('status' => 'ok');
		$serverHash = hash($hashAlgorithm, $hashToken . $text);
		if ($serverHash != $clientHash) {
			$response['status'] = 'error';
		} else {
			$response['data'] = Denkmal_Model_Message::create($venue, $text);
		}

		$this->_setContent($response);
	}

	public static function match(CM_Request_Abstract $request) {
		if (!parent::match($request)) {
			return false;
		}
		return $request->getPathPart(1) === 'message';
	}
}
