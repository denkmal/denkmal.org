<?php

class Admin_Component_EventEdit extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $event->getVenue();

        $songListSuggested = new Denkmal_Paging_Song_Suggestion($event);
        $songListSuggested->setPage(1, 3);

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);
        $viewResponse->set('songListSuggested', $songListSuggested);
        $viewResponse->set('eventDuplicates', $event->getDuplicates());
    }
}
