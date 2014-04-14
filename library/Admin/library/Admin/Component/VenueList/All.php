<?php

class Admin_Component_VenueList_All extends Admin_Component_VenueList_Abstract {

    public function prepare() {
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        if (null !== $searchTerm) {
            $venueList = new Denkmal_Paging_Venue_Search($searchTerm);
        } else {
            $venueList = new Denkmal_Paging_Venue_All();
        }

        $venueList->setPage($this->_params->getPage(), $this->_params->getInt('count', 20));

        $this->setTplParam('venueList', $venueList);
    }
}
