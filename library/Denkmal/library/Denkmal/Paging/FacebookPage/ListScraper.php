<?php

class Denkmal_Paging_FacebookPage_ListScraper extends Denkmal_Paging_FacebookPage_Abstract {

    /** @var Denkmal_Model_Region */
    private $_region;

    /**
     * @param Denkmal_Model_Region $region
     */
    public function __construct(Denkmal_Model_Region $region) {
        $this->_region = $region;

        $where = 'region = ' . $region->getId();
        $source = new CM_PagingSource_Sql('facebookPage', 'denkmal_scraper_facebookpage', $where, 'id');

        parent::__construct($source);
    }

    /**
     * @param Denkmal_Model_FacebookPage $facebookPage
     */
    public function add(Denkmal_Model_FacebookPage $facebookPage) {
        CM_Db_Db::replace('denkmal_scraper_facebookpage', [
            'facebookPage' => $facebookPage->getId(),
            'region'       => $this->_region->getId(),
            'created'      => time(),
        ]);
    }

    /**
     * @param Denkmal_Model_FacebookPage $facebookPage
     */
    public function remove(Denkmal_Model_FacebookPage $facebookPage) {
        CM_Db_Db::delete('denkmal_scraper_facebookpage', [
            'facebookPage' => $facebookPage->getId(),
            'region'       => $this->_region->getId(),
        ]);
    }

}
