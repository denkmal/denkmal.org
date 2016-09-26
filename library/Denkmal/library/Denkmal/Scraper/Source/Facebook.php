<?php

class Denkmal_Scraper_Source_Facebook extends Denkmal_Scraper_Source_Abstract {

    public function run(Denkmal_Scraper_Manager $manager) {
        $serviceManager = CM_Service_Manager::getInstance();
        /** @var \Facebook\Facebook $facebookClient */
        $facebookClient = $serviceManager->get('facebook', '\Facebook\Facebook');

        /** @var Denkmal_Model_Region[] $regionList */
        $regionList = (new Denkmal_Paging_Region_All())->getItems();

        return Functional\flatten(Functional\map($regionList, function (Denkmal_Model_Region $region) use ($facebookClient) {
            $facebookAppCredentials = $region->getFacebookAppCredentials();
            if (!$facebookAppCredentials) {
                return [];
            }

            $venueList = (new Denkmal_Paging_Venue_All($region))->getItems();
            return $this->processVenueList($venueList, $facebookClient);
        }));
    }

    /**
     * @param array              $venueList
     * @param \Facebook\Facebook $facebookClient
     * @return Denkmal_Scraper_EventData[]
     */
    public function processVenueList(array $venueList, \Facebook\Facebook $facebookClient) {
        $eventDataList = Functional\flatten(Functional\map($venueList, function (Denkmal_Model_Venue $venue) use ($facebookClient) {
            $facebookPage = $venue->getFacebookPage();
            if (!$facebookPage) {
                return null;
            }

            $response = $facebookClient->get('/' . $facebookPage->getFacebookId() . '/events?limit=9999');
            $graphEdge = $response->getGraphEdge('GraphEvent');
            return Functional\map($graphEdge, function (\Facebook\GraphNodes\GraphEvent $graphNode) use ($venue) {
                return $this->_processFacebookEvent($venue->getRegion(), $venue, $graphNode);
            });
        }));
        return array_filter($eventDataList);
    }

    /**
     * @param Denkmal_Model_Region            $region
     * @param Denkmal_Model_Venue|null        $defaultVenue
     * @param \Facebook\GraphNodes\GraphEvent $graphEvent
     * @return Denkmal_Scraper_EventData|null
     * @throws CM_Exception
     */
    protected function _processFacebookEvent(Denkmal_Model_Region $region, Denkmal_Model_Venue $defaultVenue = null, \Facebook\GraphNodes\GraphEvent $graphEvent) {
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
}
