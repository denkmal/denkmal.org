<?php

class Admin_Form_Event extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('eventId', new CM_FormField_Hidden());

		$this->registerField('venue', new Denkmal_FormField_Venue());
		$this->registerField('venueAddress', new CM_FormField_Text());
		$this->registerField('venueUrl', new CM_FormField_Text());

		$this->registerField('date', new CM_FormField_Date(date('Y'), (int) date('Y') + 1));
		$this->registerField('fromTime', new Denkmal_FormField_Time());
		$this->registerField('untilTime', new Denkmal_FormField_Time());

		$this->registerField('title', new CM_FormField_Text());
		$this->registerField('description', new CM_FormField_Text());

		$this->registerField('enable', new CM_FormField_Boolean());

		$this->registerAction(new Admin_FormAction_Event_Save($this));
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		$event = $params->getEvent('event');

		$this->getField('eventId')->setValue($event->getId());
		$this->getField('venue')->setValue($event->getVenue());
		$this->getField('date')->setValue($event->getFrom());
		$this->getField('fromTime')->setValue($event->getFrom());
		$this->getField('untilTime')->setValue($event->getUntil());
		$this->getField('title')->setValue($event->getTitle());
		$this->getField('description')->setValue($event->getDescription());
		$this->getField('enable')->setValue(true);
	}
}
