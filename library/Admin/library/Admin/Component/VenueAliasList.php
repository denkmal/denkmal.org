<?php

class Admin_Component_VenueAliasList extends Admin_Component_Abstract {

	public function prepare() {
		$venue = $this->_params->getVenue('venue');

		$venueAliasList = new Denkmal_Paging_VenueAlias_Venue($venue);

		$this->setTplParam('venue', $venue);
		$this->setTplParam('venueAliasList', $venueAliasList);
	}

	public static function ajax_deleteAlias(CM_Params $params, CM_ComponentFrontendHandler $handler, CM_Response_View_Ajax $response) {
		$id = $params->getInt('id');
		$venueAlias = new Denkmal_Model_VenueAlias($id);
		$venueAlias->delete();
		$response->reloadComponent();
	}
}
