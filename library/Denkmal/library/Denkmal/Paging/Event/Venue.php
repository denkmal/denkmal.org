<?php

class Denkmal_Paging_Event_Venue extends Denkmal_Paging_Event_Abstract {

    /**
     * @param Denkmal_Model_Venue $venue
     */
    public function __construct(Denkmal_Model_Venue $venue) {
        $where = '`venue` = ' . $venue->getId();
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where);
        parent::__construct($source);
    }
}
