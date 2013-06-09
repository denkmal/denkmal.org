<?php

class Denkmal_Form_EventAdd extends CM_Form_Abstract {

	public function setup () {
		$this->registerField(new Denkmal_FormField_Venue('venue'));
		$this->registerField(new CM_FormField_Text('venueAddress'));
		$this->registerField(new CM_FormField_Text('venueUrl'));

		$this->registerField(new CM_FormField_Date('date', date('Y'), (int) date('Y') + 1));
		$this->registerField(new Denkmal_FormField_Time('fromTime'));
		$this->registerField(new Denkmal_FormField_Time('untilTime'));

		$this->registerField(new CM_FormField_Text('title'));
		$this->registerField(new CM_FormField_Text('artists'));
		$this->registerField(new CM_FormField_Text('genres'));
		$this->registerField(new CM_FormField_Text('urls'));

		$this->registerAction(new Denkmal_FormAction_EventAdd_Create());
	}

}
