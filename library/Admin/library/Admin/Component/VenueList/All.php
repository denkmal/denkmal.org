<?php

class Admin_Component_VenueList_All extends Admin_Component_VenueList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->getParams()->has('region') ? $this->getParams()->getRegion('region') : null;
        $searchTerm = $this->getParams()->has('searchTerm') ? $this->getParams()->getString('searchTerm') : null;

        if (null !== $searchTerm) {
            $venueList = new Denkmal_Paging_Venue_Search($searchTerm);
        } else {
            $venueList = new Denkmal_Paging_Venue_All($region);
        }

        $venueList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $viewResponse->set('venueList', $venueList);
    }
}
