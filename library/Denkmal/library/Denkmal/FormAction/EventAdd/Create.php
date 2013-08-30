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
			$address = $params->has('venueAddress') ? $params->getString('venueAddress') : null;
			$url = $params->has('venueUrl') ? $params->getString('venueUrl') : null;
			$venueData = array(
				'name'    => (string) $venue,
				'queued'  => true,
				'enabled' => false,
				'address' => $address,
				'url'     => $url,
			);
			$venue = Denkmal_Model_Venue::createStatic($venueData);
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

		$eventData = array(
			'venue'       => $venue,
			'from'        => $from,
			'until'       => $until,
			'title'       => $title,
			'description' => $description,
			'queued'      => true,
			'enabled'     => false,
		);
		Denkmal_Model_Event::createStatic($eventData);
	}
}
