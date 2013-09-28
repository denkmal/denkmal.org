<?php

class Admin_Form_VenueMerge extends CM_Form_Abstract {

	public function setup() {
		$this->registerField('oldVenue', new CM_FormField_Hidden());
		$this->registerField('newVenue', new Denkmal_FormField_Venue(false));

		$this->registerAction(new Admin_FormAction_Venue_Merge($this));
	}

	protected function _renderStart(CM_Params $params) {
		/** @var Denkmal_Params $params */
		$venue = $params->getVenue('venue');

		$this->getField('oldVenue')->setValue($venue->getId());
	}
}
