<?php

class Denkmal_Action_Message extends Denkmal_Action_Abstract {

	const TYPE = 100;

	public function notify(Denkmal_Model_Message $message) {
		$this->_notify($message);
	}

	protected function _notifyCreate(Denkmal_Model_Message $message) {
		CM_Model_StreamChannel_Message::publish('global-external', 'message-create', array(
			'id'      => $message->getId(),
			'venue'   => $message->getVenue()->getId(),
			'created' => $message->getCreated()->getTimestamp(),
			'text'    => $message->getText(),
		));
	}
}
