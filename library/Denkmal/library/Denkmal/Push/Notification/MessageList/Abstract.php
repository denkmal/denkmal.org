<?php

abstract class Denkmal_Push_Notification_MessageList_Abstract extends \CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Push_Notification_Message($itemRaw);
    }
}
