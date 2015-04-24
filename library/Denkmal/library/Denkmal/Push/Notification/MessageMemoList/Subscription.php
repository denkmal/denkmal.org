<?php

class Denkmal_Push_Notification_MessageMemoList_Subscription extends Denkmal_Push_Notification_MessageMemoList_Abstract {

    /**
     * @param Denkmal_Push_Subscription $subscription
     */
    public function __construct(Denkmal_Push_Subscription $subscription) {
        $where = 'subscription = ' . $subscription->getId();
        $source = new CM_PagingSource_Sql('id', 'denkmal_push_notification_messagememo', $where, 'id DESC');

        parent::__construct($source);
    }
}
