<?php

class Denkmal_Http_Response_Api_Events extends Denkmal_Http_Response_Api_Abstract {

    public function __construct(CM_Http_Request_Get $request, CM_Service_Manager $serviceManager) {
        parent::__construct($request, $serviceManager);
    }

    protected function _process() {
        $settings = new Denkmal_App_Settings();
        $suspension = $settings->getSuspension();
        $venueName = $this->_params->getString('venue');
        $venue = Denkmal_Model_Venue::findByNameOrAlias($venueName);
        if (null === $venue) {
            throw new CM_Exception('Cannot find venue with name `' . $venueName . '`');
        }
        $maxEvents = min(max($this->_params->getInt('maxEvents', 100), 1), 1000);

        $eventListArray = array();
        if (!$suspension->isActive()) {
            $eventList = new Denkmal_Paging_Event_VenueFuture($venue);
            $eventList->setPage(1, $maxEvents);
            $eventListArray = Functional\map($eventList, function (Denkmal_Model_Event $event) {
                return $event->toArrayApi($this->getRender());
            });
        }

        $this->_setContent(array(
            'events' => $eventListArray,
        ));
    }

    public static function match(CM_Http_Request_Abstract $request) {
        if (!parent::match($request)) {
            return false;
        }
        return $request->getPathPart(1) === 'events';
    }
}
