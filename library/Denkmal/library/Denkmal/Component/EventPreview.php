<?php

class Denkmal_Component_EventPreview extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

        $settings = new Denkmal_App_Settings();
        $fromDate = $event->getFrom();
        $fromDateDisplay = clone $fromDate;
        $fromDateDisplay->sub(new DateInterval('PT' . $settings->getDayOffset() . 'H'));

        if ($fromDate->format('d.m.Y') != $fromDateDisplay->format('d.m.Y')) {
            $viewResponse->set('fromDateDisplay', $fromDateDisplay);
        }

        if ($venue->hasIdRaw()) {
            $viewResponse->set('eventDuplicates', new Denkmal_Paging_Event_VenueDate($event->getFrom(), $venue, true));
        }

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
