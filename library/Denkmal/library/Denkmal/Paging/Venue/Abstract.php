<?php

class Denkmal_Paging_Venue_Abstract extends CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_Venue($itemRaw);
    }

    /**
     * @param Denkmal_Model_Venue $venue
     * @return bool
     */
    public function containsVenue(Denkmal_Model_Venue $venue) {
        return in_array($venue->getId(), $this->getItemsRaw());
    }
}
