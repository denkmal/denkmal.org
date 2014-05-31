<?php

class Admin_Component_VenueAliasList extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->getVenue('venue');

        $venueAliasList = new Denkmal_Paging_VenueAlias_Venue($venue);

        $viewResponse->set('venue', $venue);
        $viewResponse->set('venueAliasList', $venueAliasList);
    }

    public function ajax_deleteAlias(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Response_View_Ajax $response) {
        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_NotAllowed();
        }

        /** @var Denkmal_Params $params */
        $venueAlias = $params->getVenueAlias('id');
        $venueAlias->delete();
        $response->reloadComponent();
    }
}
