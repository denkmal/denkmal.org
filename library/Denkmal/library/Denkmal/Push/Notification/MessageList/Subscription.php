<?php

class Denkmal_Push_Notification_MessageList_Subscription extends Denkmal_Push_Notification_MessageList_Abstract {

    /**
     * @param Denkmal_Push_Subscription $subscription
     */
    public function __construct(Denkmal_Push_Subscription $subscription) {
        $where = 'subscription = ' . $subscription->getId();
        $source = new CM_PagingSource_Sql('id', 'denkmal_push_notification_message', $where, 'id DESC');

        parent::__construct($source);
    }
}
