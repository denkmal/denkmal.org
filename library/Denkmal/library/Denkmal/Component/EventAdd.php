<?php

class Denkmal_Component_EventAdd extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->_params->getRegion('region');

        $venueList = new Denkmal_Paging_Venue_All($region);
        /** @var Denkmal_Model_Venue $venue */
        $venue = $venueList->getItemRand();
        $venuePlaceholder = $venue ? $venue->getName() : 'Venue name';

        $viewResponse->set('region', $region);
        $viewResponse->set('venuePlaceholder', $venuePlaceholder);
    }
}
