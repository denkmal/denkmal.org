<?php

class Denkmal_Component_EventList extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $region = $this->getParams()->getRegion('region');
        $date = $this->getParams()->getDateTime('date');
        /** @var Denkmal_Paging_Venue_Abstract $venueBookmarks */
        $venueBookmarks = $this->getParams()->getObject('venueBookmarks', 'Denkmal_Paging_Venue_Abstract');
        /** @var Denkmal_Model_Event[] $events */
        $events = (new Denkmal_Paging_Event_Date($region, $date))->getItems();

        $eventsSorted = [];
        foreach ($events as $event) {
            $sortKey = join('-', [
                ($venueBookmarks->containsVenue($event->getVenue()) ? '1' : '2'),
                strtolower($event->getVenue()->getName()),
            ]);
            $eventsSorted[$sortKey] = $event;
        }
        ksort($eventsSorted);

        $viewResponse->set('date', $date);
        $viewResponse->set('events', $eventsSorted);
        $viewResponse->set('venueBookmarks', $venueBookmarks);
        $viewResponse->set('region', $region);
        $viewResponse->set('twitterAccount', $region->getTwitterAccount());
        $viewResponse->set('facebookAccount', $region->getFacebookAccount());
    }
}
