<?php

class Admin_FormAction_Venue_Merge extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('oldVenue', 'newVenue');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$oldVenue = $params->getVenue('oldVenue');
		$newVenue = $params->getVenue('newVenue');

		/** @var Denkmal_Model_Event $event */
		foreach ($oldVenue->getEventList() as $event) {
			$event->setVenue($newVenue);
		}

		$oldVenue->delete();
	}
}
