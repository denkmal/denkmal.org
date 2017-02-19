<?php

class Denkmal_Paging_EventLink_Event extends Denkmal_Paging_EventLink_Abstract {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $where = 'event = ' . $event->getId();
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_eventlink', $where, 'label asc');
        $source->enableCache();
        parent::__construct($source);
    }
}
