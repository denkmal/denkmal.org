<?php

class Admin_FormAction_Venue_Delete extends Admin_FormAction_Abstract {

	protected function _getRequiredFields() {
		return array('venueId');
	}

	protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
		/** @var Denkmal_Params $params */
		$venue = $params->getVenue('venueId');

		$venue->delete();
	}
}
