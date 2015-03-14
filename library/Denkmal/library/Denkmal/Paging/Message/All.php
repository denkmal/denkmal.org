<?php

class Denkmal_Paging_Message_All extends Denkmal_Paging_Message_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_message', null, '`created` DESC');
        $source->enableCache();
        parent::__construct($source);
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
