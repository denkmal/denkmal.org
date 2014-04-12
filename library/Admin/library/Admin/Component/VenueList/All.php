<?php

class Admin_Component_VenueList_All extends Admin_Component_VenueList_Abstract {

    public function prepare() {
        $venueList = new Denkmal_Paging_Venue_All();

        $this->setTplParam('venueList', $venueList);
    }
}
