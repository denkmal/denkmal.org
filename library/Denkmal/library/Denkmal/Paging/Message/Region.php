<?php

class Denkmal_Paging_Message_Region extends Denkmal_Paging_Message_Abstract {

    /**
     * @param Denkmal_Model_Region $region
     */
    public function __construct(Denkmal_Model_Region $region) {
        $where = 'denkmal_model_venue.region = ' . $region->getId();
        $join = 'JOIN denkmal_model_venue ON(denkmal_model_venue.id = denkmal_model_message.venue)';
        $source = new CM_PagingSource_Sql('denkmal_model_message.id', 'denkmal_model_message', $where, '`created` DESC', $join);
        $source->enableCache();
        parent::__construct($source);
    }
}
