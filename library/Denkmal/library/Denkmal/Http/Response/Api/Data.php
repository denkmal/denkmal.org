<?php

class Denkmal_Http_Response_Api_Data extends Denkmal_Http_Response_Api_Abstract {

    public function __construct(CM_Http_Request_Get $request, CM_Service_Manager $serviceManager) {
        parent::__construct($request, $serviceManager);
    }

    protected function _process() {
        $settings = new Denkmal_App_Settings();
        $suspension = $settings->getSuspension();

        $venueListArray = array();
        /** @var Denkmal_Model_Venue $venue */
        foreach (new Denkmal_Paging_Venue_All() as $venue) {
            $venueListArray[] = $venue->toArrayApi($this->getRender());
        }

        $eventListArray = array();
        if (!$suspension->isActive()) {
            /** @var DateTime $date */
            foreach (new Denkmal_Paging_DateTime_Days() as $date) {
                /** @var Denkmal_Model_Event $event */
                foreach (new Denkmal_Paging_Event_Date($date) as $event) {
                    $eventListArray[] = $event->toArrayApi($this->getRender());
                }
            }
        }

        $this->_setContent(array(
            'venues'        => $venueListArray,
            'events'        => $eventListArray,
            'dayOffset'     => $settings->getDayOffset(),
            'suspendedDays' => $suspension->isActive() ? $suspension->getDaysLeft() : null,
        ));
    }

    public static function match(CM_Http_Request_Abstract $request) {
        if (!parent::match($request)) {
            return false;
        }
        return $request->getPathPart(1) === 'data';
    }
}
