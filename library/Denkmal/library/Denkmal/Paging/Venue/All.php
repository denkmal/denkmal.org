<?php

class Denkmal_Paging_Venue_All extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param Denkmal_Model_Region|null $region
     * @param boolean|null              $showAll
     */
    public function __construct(Denkmal_Model_Region $region = null, $showAll = null) {
        $where = '1 = 1';
        if ($region) {
            $where .= ' AND region = ' . $region->getId();
        }
        if (!$showAll) {
            $where .= ' AND (`suspended` = 0 AND `ignore` = 0)';
        }
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, 'LOWER(`name`)');
        $source->enableCache();
        parent::__construct($source);
    }
}
