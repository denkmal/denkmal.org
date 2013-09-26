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
		/** @var Denkmal_Params $params */
		$venue = $params->get('venue');
		if (!$venue instanceof Denkmal_Model_Venue) {
			$name = (string) $venue;
			$address = $params->has('venueAddress') ? $params->getString('venueAddress') : null;
			$url = $params->has('venueUrl') ? $params->getString('venueUrl') : null;

			$venue = Denkmal_Model_Venue::create($name, true, false, false, $url, $address);
		}

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

		$title = $params->getString('title');
		$descriptionParts = array();
		$descriptionParts[] = $params->getString('artists', '');
		$descriptionParts[] = $params->getString('genres', '');
		$descriptionParts[] = $params->getString('urls', '');
		$descriptionParts = array_filter($descriptionParts, 'trim');
		$description = implode(' ', $descriptionParts);

		if (empty($description)) {
			$description = $title;
			$title = null;
		}
		Denkmal_Model_Event::create($venue, $description, false, true, $from, $until, $title);
	}
}
