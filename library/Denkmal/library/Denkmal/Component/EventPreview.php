<?php

class Denkmal_Component_EventPreview extends Denkmal_Component_Abstract {

    public function prepare() {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

        $fromDate = $event->getFrom();
        $fromDateDisplay = clone $fromDate;
        $fromDateDisplay->sub(new DateInterval('PT' . Denkmal_Site::getDayOffset() . 'H'));

        if ($fromDate->format('d.m.Y') != $fromDateDisplay->format('d.m.Y')) {
            $this->setTplParam('fromDateDisplay', $fromDateDisplay);
        }

        if ($venue->hasIdRaw()) {
            $eventDuplicates = new Admin_Paging_Event_VenueDate($event->getFrom(), $venue);
            $this->setTplParam('eventDuplicates', $eventDuplicates);
        }

        $this->setTplParam('event', $event);
        $this->setTplParam('venue', $venue);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
