<?php

class Denkmal_Paging_FacebookPage_ListScraper extends Denkmal_Paging_FacebookPage_Abstract {

    /** @var Denkmal_Model_Region|null */
    private $_region;

    /**
     * @param Denkmal_Model_Region|null $region
     */
    public function __construct(Denkmal_Model_Region $region = null) {
        $this->_region = $region;

        $where = null;
        if ($region) {
            $where = 'region = ' . $region->getId();
        }
        $source = new CM_PagingSource_Sql('DISTINCT(facebookPage)', 'denkmal_scraper_facebookpage', $where, 'id DESC');

        parent::__construct($source);
    }

    /**
     * @param Denkmal_Model_FacebookPage $facebookPage
     * @throws CM_Exception
     */
    public function add(Denkmal_Model_FacebookPage $facebookPage) {
        if (!$this->_region) {
            throw new CM_Exception('No region set');
        }
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
        $where = [
            'facebookPage' => $facebookPage->getId(),
        ];
        if ($this->_region) {
            $where['region'] = $this->_region->getId();
        }
        CM_Db_Db::delete('denkmal_scraper_facebookpage', $where);
    }

}
