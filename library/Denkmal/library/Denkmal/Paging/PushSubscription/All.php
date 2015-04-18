<?php

class Denkmal_Paging_PushSubscription_All extends \Denkmal_Paging_PushSubscription_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', Denkmal_Push_Subscription::getTableName());
        $source->enableCache();
        parent::__construct($source);
    }
}
