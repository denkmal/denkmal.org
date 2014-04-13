<?php

class Admin_Component_VenueList_Queued extends Admin_Component_VenueList_Abstract {

    public function prepare() {
        $venueList = new Admin_Paging_Venue_Queued();
        $venueList->setPage($this->_params->getPage(), $this->_params->getInt('count', 10));

        $this->setTplParam('venueList', $venueList);
    }
}
