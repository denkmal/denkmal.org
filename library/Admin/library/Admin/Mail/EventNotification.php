<?php

class Admin_Mail_EventNotification extends CM_Mail {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $site = new Admin_Site();
        $region = $event->getVenue()->getRegion();
        parent::__construct($region->getEmailAddress(), array(
            'event' => $event,
            'venue' => $event->getVenue(),
        ), $site);
    }
}
