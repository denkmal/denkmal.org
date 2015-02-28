<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

        $isPersistent = ($event->hasIdRaw() && $venue->hasIdRaw());

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);
        $viewResponse->set('allowDetails', $isPersistent);

        if ($isPersistent) {
            $viewResponse->getJs()->setProperty('event', $event);
            $viewResponse->getJs()->setProperty('venue', $venue);
            $viewResponse->set('tagList', $this->_getTagList($venue, $event));
        } else {
            $this->_params = CM_Params::factory(); // Empty params to not send them to client
        }
    }

    /**
     * @param Denkmal_Model_Venue $venue
     * @param Denkmal_Model_Event $event
     * @return Denkmal_Paging_Tag_Abstract|null
     */
    private function _getTagList(Denkmal_Model_Venue $venue, Denkmal_Model_Event $event) {
        $tagList = null;
        $now = new DateTime();
        $dateFrom = clone $event->getFrom();
        $dateFrom = $dateFrom->modify('-3 hours');
        $dateUntil = $event->getUntilEndOfDay();

        if ($dateFrom < $now && $now < $dateUntil) {
            $tagList = new Denkmal_Paging_Tag_VenueUserLatest($venue, $now->modify('-4 hours'));
            $tagList->setPage(1, 3);
        }

        return $tagList;
    }
}
