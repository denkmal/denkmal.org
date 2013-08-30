<?php

class Denkmal_Form_EventAdd extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('venue', new Denkmal_FormField_Venue());
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
	}
}
