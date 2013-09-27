<?php

class Admin_FormAction_Event_Save extends CM_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('venue', 'date', 'fromTime', 'description');
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
		/** @var Denkmal_Params $params */
		$event = $params->getEvent('eventId');
		$venue = $params->getVenue('venue');

		$date = $params->getDateTime('date');
		$from = clone $date;
		$from->add($params->getDateInterval('fromTime'));
		$until = null;
		if ($params->has('untilTime')) {
			$until = clone $date;
			$until->add($params->getDateInterval('untilTime'));
			if ($until < $from) {
				$until->add(new DateInterval('P1D'));
			}
		}

		$title = $params->has('title') ? $params->getString('title') : null;
		$description = $params->getString('description');
		$activate = $params->getBoolean('activate');

		$event->setVenue($venue);
		$event->setDescription($description);
		if ($activate) {
			$event->setEnabled(true);
			$event->setQueued(false);
		}
		$event->setFrom($from);
		$event->setUntil($until);
		$event->setTitle($title);

		$response->reloadComponent();
	}
}
