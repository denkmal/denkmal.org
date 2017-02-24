<?php

class Admin_Component_Event extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $event->getVenue();
        $allowEditing = $this->_params->getBoolean('allowEditing', true);

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);
        $viewResponse->set('eventDuplicates', $event->getDuplicates());
        $viewResponse->set('allowEditing', $allowEditing);
        $viewResponse->getJs()->setProperty('event', $event);
    }
}
