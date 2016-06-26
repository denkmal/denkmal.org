<?php

class Admin_Paging_Venue_Queued extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param Denkmal_Model_Region $region
     */
    public function __construct(Denkmal_Model_Region $region) {
        $where = '`queued` = 1';
        $where .= ' AND region = ' . $region->getId();

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, '`name`');
        parent::__construct($source);
    }
}
