<?php

class Denkmal_Paging_PushNotification_All extends \Denkmal_Paging_PushNotification_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', Denkmal_Model_PushSubscription::getTableName());
        $source->enableCache();
        parent::__construct($source);
    }
}
