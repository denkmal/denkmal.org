<?php

abstract class Denkmal_Push_Notification_MessageMemoList_Abstract extends \CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Push_Notification_MessageMemo($itemRaw);
    }
}
