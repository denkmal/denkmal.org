<?php

class Denkmal_Paging_Event_Song extends Denkmal_Paging_Event_Abstract {

    /**
     * @param Denkmal_Model_Song $song
     */
    public function __construct(Denkmal_Model_Song $song) {
        $where = '`song` = ' . $song->getId();
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where);
        parent::__construct($source);
    }
}
