<?php

use function Functional\flatten;
use function Functional\map;
use function Functional\reject;

class Denkmal_Scraper_Source_Facebook_Venues extends Denkmal_Scraper_Source_Facebook_Abstract {

    public function run(DateTime $now, array $dateList) {
        /** @var Denkmal_Model_Venue[] $venueList */
        $venueList = (new Denkmal_Paging_Venue_All())->getItems();
        $venueList = reject($venueList, function (Denkmal_Model_Venue $venue) {
            return null === $venue->getFacebookPage();
        });

        return flatten(map($venueList, function (Denkmal_Model_Venue $venue) {
            return $this->processVenue($venue);
        }));
    }

    /**
     * @param Denkmal_Model_Venue $venue
     * @return Denkmal_Scraper_EventData[]
     * @throws CM_Exception
     */
    public function processVenue(Denkmal_Model_Venue $venue) {
        $facebookPage = $venue->getFacebookPage();
        if (!$facebookPage) {
            throw new CM_Exception('Venue has no facebook page');
        }

        return $this->_processFacebookPage($facebookPage, $venue->getRegion(), $venue);
    }

}
