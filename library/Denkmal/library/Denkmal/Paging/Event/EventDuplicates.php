<?php

class Denkmal_Paging_Event_EventDuplicates extends Denkmal_Paging_Event_VenueDate {

    /**
     * @param DateTime                   $eventFrom
     * @param Denkmal_Model_Venue        $venue
     * @param Denkmal_Model_Event[]|null $excludeEvents
     */
    public function __construct(DateTime $eventFrom, Denkmal_Model_Venue $venue, $excludeEvents = null) {
        $settings = new Denkmal_App_Settings();

        $eventFrom = clone $eventFrom;
        $eventFrom->sub(new DateInterval('PT' . $settings->getDayOffset() . 'H'));

        parent::__construct($eventFrom, $venue, true, $excludeEvents);
    }
}
