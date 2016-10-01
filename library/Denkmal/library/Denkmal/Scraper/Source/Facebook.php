<?php

use function Functional\flatten;
use function Functional\map;
use function Functional\reject;

class Denkmal_Scraper_Source_Facebook extends Denkmal_Scraper_Source_Abstract {

    public function run(array $dateList) {
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

    /**
     * @param Denkmal_Model_FacebookPage $facebookPage
     * @param Denkmal_Model_Region       $region
     * @param Denkmal_Model_Venue|null   $defaultVenue
     * @return Denkmal_Scraper_EventData[]
     */
    protected function _processFacebookPage(Denkmal_Model_FacebookPage $facebookPage, Denkmal_Model_Region $region, Denkmal_Model_Venue $defaultVenue = null) {
        $facebookClient = $this->_getFacebookClient();
        $facebookPageId = $facebookPage->getFacebookId();
        $response = $facebookClient->get('/' . $facebookPageId . '/events?limit=9999');
        $graphEdge = $response->getGraphEdge('GraphEvent');
        return map($graphEdge, function (\Facebook\GraphNodes\GraphEvent $graphNode) use ($region, $defaultVenue, $facebookPageId) {
            $eventData = $this->_processFacebookEvent($graphNode, $region, $defaultVenue);
            $eventData->setSourceIdentifier('facebook-page:' . $facebookPageId);
            return $eventData;
        });
    }

    /**
     * @param \Facebook\GraphNodes\GraphEvent $graphEvent
     * @param Denkmal_Model_Region            $region
     * @param Denkmal_Model_Venue|null        $defaultVenue
     * @return Denkmal_Scraper_EventData|null
     * @throws CM_Exception
     */
    protected function _processFacebookEvent(\Facebook\GraphNodes\GraphEvent $graphEvent, Denkmal_Model_Region $region, Denkmal_Model_Venue $defaultVenue = null) {
        $description = new Denkmal_Scraper_Description($graphEvent->getField('name'));
        $from = $graphEvent->getField('start_time');
        $until = $graphEvent->getField('end_time');

        $venue = $defaultVenue;
        if ($graphEvent->getField('place')) {
            $place = $graphEvent->getPlace();
            if ($place->getField('location')) {
                $location = $place->getLocation();

                $locationGeoPoint = new CM_Geo_Point($location->getLatitude(), $location->getLongitude());
                $regionGeoPoint = $region->getLocation()->getGeoPoint();
                $distance = $regionGeoPoint->calculateDistanceTo($locationGeoPoint);
                if ($distance > 1000 * 50) {
                    $venue = null;
                } else {
                    $venue = $place->getName();
                }
            }
        }
        if (!$venue) {
            return null;
        }

        return new Denkmal_Scraper_EventData($region, $venue, $description, $from, $until);
    }

    /**
     * @return \Facebook\Facebook
     */
    protected function _getFacebookClient() {
        $serviceManager = CM_Service_Manager::getInstance();
        return $serviceManager->get('facebook', '\Facebook\Facebook');
    }

}
