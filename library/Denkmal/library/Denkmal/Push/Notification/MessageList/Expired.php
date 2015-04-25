<?php

class Denkmal_Push_Notification_MessageList_Expired extends Denkmal_Push_Notification_MessageList_Abstract {

    /**
     * @param DateTime|null $now
     */
    public function __construct(DateTime $now = null) {
        if (null === $now) {
            $now = new DateTime();
        }

        $where = 'expires < ' . $now->getTimestamp();
        $source = new CM_PagingSource_Sql('id', 'denkmal_push_notification_message', $where, 'id DESC');

        parent::__construct($source);
    }
}
