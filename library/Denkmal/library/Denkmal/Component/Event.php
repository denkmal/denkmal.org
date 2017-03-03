<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();
        /** @var Denkmal_Paging_Venue_Abstract|null $venueBookmarks */
        $venueBookmarks = $this->_params->has('venueBookmarks') ? $this->_params->getObject('venueBookmarks', 'Denkmal_Paging_Venue_Abstract') : null;

        $mapLink = null;
        if ($venue->getCoordinates() && !$venue->getSecret()) {
            $mapLink = CM_Util::link('https://www.google.com/maps', [
                'q' => $venue->getName() . '@' . $venue->getCoordinates()->getLatitude() . ',' . $venue->getCoordinates()->getLongitude(),
            ]);
        }

        $isPersistent = ($event->hasIdRaw() && $venue->hasIdRaw());
        $isBookmarked = $venueBookmarks ? $venueBookmarks->containsVenue($venue) : false;

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);
        $viewResponse->set('mapLink', $mapLink);
        $viewResponse->set('isBookmarked', $isBookmarked);
        $viewResponse->set('isPersistent', $isPersistent);

        if (!$isPersistent) {
            $this->_params = CM_Params::factory(); // Empty params to not send them to client
        } else {
            $viewResponse->getJs()->setProperty('_venue', $venue);
        }
    }
}
