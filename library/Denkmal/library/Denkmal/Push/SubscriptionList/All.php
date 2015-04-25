<?php

class Denkmal_Push_SubscriptionList_All extends Denkmal_Push_SubscriptionList_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', Denkmal_Push_Subscription::getTableName());
        $source->enableCache();
        parent::__construct($source);
    }
}
