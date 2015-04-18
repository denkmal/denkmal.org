<?php

abstract class Denkmal_Paging_PushSubscription_Abstract extends \CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Push_Subscription($itemRaw);
    }
}
