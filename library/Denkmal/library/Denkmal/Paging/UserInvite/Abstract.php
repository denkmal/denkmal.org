<?php

class Denkmal_Paging_UserInvite_Abstract extends CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_UserInvite($itemRaw);
    }
}
