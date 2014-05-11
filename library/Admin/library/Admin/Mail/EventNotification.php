<?php

class Admin_Mail_EventNotification extends CM_Mail {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $site = new Admin_Site();
        parent::__construct($site->getEmailAddress(), array(
            'event' => $event,
            'venue' => $event->getVenue(),
        ), $site);
    }
}
