<?php

abstract class Denkmal_Paging_EventCategory_Abstract extends CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_EventCategory($itemRaw);
    }
}
