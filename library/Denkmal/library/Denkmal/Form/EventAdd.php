<?php

class Denkmal_Form_EventAdd extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('venue', new Denkmal_FormField_Venue(true));
		$this->registerField('venueAddress', new CM_FormField_Text());
		$this->registerField('venueUrl', new CM_FormField_Text());

		$this->registerField('date', new CM_FormField_Date(date('Y'), (int) date('Y') + 1));
		$this->registerField('fromTime', new Denkmal_FormField_Time());
		$this->registerField('untilTime', new Denkmal_FormField_Time());

		$this->registerField('title', new CM_FormField_Text());
		$this->registerField('artists', new CM_FormField_Text());
		$this->registerField('genres', new CM_FormField_Text());
		$this->registerField('urls', new CM_FormField_Text());

		$this->registerAction(new Denkmal_FormAction_EventAdd_Create($this));
	}

	protected function _renderStart(CM_Params $params) {
		$this->getField('date')->setValue(new DateTime());
		$fromTime = new DateTime();
		$fromTime->setTime(22, 00);
		$this->getField('fromTime')->setValue($fromTime);
	}

	public static function ajax_previewEvent(CM_Params $params, CM_ComponentFrontendHandler $handler, CM_Response_View_Ajax $response) {
		$className = $params->getString('className');
		$data = $params->getArray('data');

		$form = new self();
		$form->setup();

		$formAction = $form->getAction('Create');
		foreach ($formAction->getFieldList() as $name => $required) {
			$field = $form->getField($name);
			$value = $data[$name];
			$valueValidated = null;

			if (!$field->isEmpty($value)) {
				$valueValidated = $field->validate($value, $response);
			} else {
				if ($required) {
					throw new CM_Exception_FormFieldValidation('Field `' . $name . '` is required');
				}
			}
			$data[$name] = $valueValidated;
		}

		$event = self::getEventFromData(new Denkmal_Params($data));
		$venue = self::getVenueFromData(new Denkmal_Params($data));

		return $response->loadComponent(new Denkmal_Params(array('className' => $className, 'event' => $event, 'venue' => $venue)));
	}

	/**
	 * @param Denkmal_Params $params
	 * @return Denkmal_Model_Venue
	 */
	public static function getVenueFromData(Denkmal_Params $params) {
		/** @var Denkmal_Params $params */
		$venue = $params->get('venue');
		if (!$venue instanceof Denkmal_Model_Venue) {
			$name = (string) $venue;
			$address = $params->has('venueAddress') ? $params->getString('venueAddress') : null;
			$url = $params->has('venueUrl') ? $params->getString('venueUrl') : null;

			$venue = new Denkmal_Model_Venue();
			$venue->setName($name);
			$venue->setUrl($url);
			$venue->setAddress($address);
			$venue->setCoordinates(null);
			$venue->setQueued(true);
			$venue->setIgnore(false);
		}
		return $venue;
	}

	/**
	 * @param Denkmal_Params $params
	 * @return Denkmal_Model_Event
	 */
	public static function getEventFromData(Denkmal_Params $params) {
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

		$event = new Denkmal_Model_Event();
		$event->setDescription($description);
		$event->setEnabled(false);
		$event->setQueued(true);
		$event->setFrom($from);
		$event->setUntil($until);
		$event->setTitle($title);
		$event->setSong(null);
		$event->setHidden(false);
		$event->setStarred(false);

		return $event;
	}
}
