<?php

abstract class Denkmal_Paging_PushSubscription_Abstract extends \CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_PushSubscription($itemRaw);
    }
}
