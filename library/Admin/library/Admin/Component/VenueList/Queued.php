<?php

class Admin_Component_VenueList_Queued extends Admin_Component_VenueList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venueList = new Admin_Paging_Venue_Queued();
        $venueList->setPage($this->_params->getPage(), $this->_params->getInt('count', 10));

        $viewResponse->set('venueList', $venueList);
    }
}
