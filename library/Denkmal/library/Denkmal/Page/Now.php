<?php

class Denkmal_Page_Now extends Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $settings = new Denkmal_App_Settings();
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : null;

        $allowAdd = true;
        if ($settings->getAnonymousMessagingDisabled() && !$environment->getViewer()) {
            $allowAdd = false;
        }

        if ($venue) {
            $settings = new Denkmal_App_Settings();
            $eventList = new Denkmal_Paging_Event_VenueDate($settings->getCurrentDate(), $venue);
            $event = $eventList->getItem(0);
            $viewResponse->set('event', $event);
        }

        $viewResponse->set('venue', $venue);
        $viewResponse->getJs()->setProperty('venue', $venue);
        $viewResponse->set('allowAdd', $allowAdd);
    }
}
