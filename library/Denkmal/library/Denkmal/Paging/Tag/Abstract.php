<?php

class Denkmal_Paging_Tag_Abstract extends CM_Paging_Abstract {

    /**
     * @param Denkmal_Model_Tag $tag
     * @return bool
     */
    public function contains(Denkmal_Model_Tag $tag) {
        return in_array($tag->getId(), $this->getItemsRaw());
    }

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_Tag($itemRaw);
    }
}
