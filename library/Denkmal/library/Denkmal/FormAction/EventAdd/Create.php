<?php

class Denkmal_FormAction_EventAdd_Create extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('venue', 'date', 'fromTime', 'title');
	}

	protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$name = $params->get('venue');
		if (!$name instanceof Denkmal_Model_Venue) {
			if ($venue = Denkmal_Model_Venue::findByNameOrAlias($name)) {
				$response->addError('Name already used by venue `' . $venue->getName() . '`', 'venue');
			}
		}
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		$venue = Denkmal_Form_EventAdd::getVenueFromData($params);
		$venue->commit();

		$event = Denkmal_Form_EventAdd::getEventFromData($params);
		$event->setVenue($venue);
		$event->commit();
	}
}
