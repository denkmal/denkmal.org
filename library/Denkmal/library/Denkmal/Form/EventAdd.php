<?php

class Denkmal_Form_EventAdd extends CM_Form_Abstract {

	public function setup () {
		$this->registerField(new Denkmal_FormField_Venue('venue'));
		$this->registerField(new CM_FormField_Integer('int', -10, 20, 2));
		$this->registerField(new CM_FormField_Distance('locationSlider'));
		$this->registerField(new CM_FormField_Location('location', null, null, $this->getField('locationSlider')));
		$this->registerField(new CM_FormField_File('file', 2));

	}

}
