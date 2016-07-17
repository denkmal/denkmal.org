<?php

class Denkmal_Paging_Venue_All extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param Denkmal_Model_Region|null $region
     */
    public function __construct(Denkmal_Model_Region $region = null) {
        $where = null;
        if ($region) {
            $where = 'region = ' . $region->getId();
        }
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, 'LOWER(`name`)');
        $source->enableCache();
        parent::__construct($source);
    }
}
