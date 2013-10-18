<?php

class Admin_Component_VenueAliasList extends Admin_Component_Abstract {

	public function checkAccessible() {
		if (!$this->_getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_NotAllowed();
		}
	}

	public function prepare() {
		$venue = $this->_params->getVenue('venue');

		$venueAliasList = new Denkmal_Paging_VenueAlias_Venue($venue);

		$this->setTplParam('venue', $venue);
		$this->setTplParam('venueAliasList', $venueAliasList);
	}

	public static function ajax_deleteAlias(CM_Params $params, CM_ComponentFrontendHandler $handler, CM_Response_View_Ajax $response) {
		if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
			throw new CM_Exception_AuthRequired();
		}

		/** @var Denkmal_Params $params */
		$venueAlias = $params->getVenueAlias('id');
		$venueAlias->delete();
		$response->reloadComponent();
	}
}
