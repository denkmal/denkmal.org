<?php

class Denkmal_Paging_Message_Abstract extends CM_Paging_Abstract {

    protected function _processItem($itemRaw) {
        return new Denkmal_Model_Message($itemRaw);
    }

    /**
     * @return int
     */
    public function getLastActivityStamp() {
        /** @var Denkmal_Model_Message $messageLast */
        $messageLast = $this->setPage(1, 1)->getItem(0);

        $lastActivityStamp = 0;
        if (null !== $messageLast) {
            $lastActivityStamp = $messageLast->getCreated()->getTimestamp();
        }

        return $lastActivityStamp;
    }
}
