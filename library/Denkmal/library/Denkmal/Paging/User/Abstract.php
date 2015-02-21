<?php

abstract class Denkmal_Paging_User_Abstract extends CM_Paging_User_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_User($itemRaw);
    }
}
