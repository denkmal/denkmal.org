<?php

class Denkmal_Paging_ScraperSourceResult_ScraperSource extends Denkmal_Paging_ScraperSourceResult_Abstract {

    /**
     * @param Denkmal_Scraper_Source_Abstract $source
     * @param DateTime|null                   $createdMin
     */
    public function __construct(Denkmal_Scraper_Source_Abstract $source, DateTime $createdMin = null) {
        $where = '`sourceType` = ' . $source->getType();
        if (null !== $createdMin) {
            $where .= ' AND `created` > ' . $createdMin->getTimestamp();
        }
        $source = new CM_PagingSource_Sql('id', 'denkmal_scraper_sourceresult', $where);
        parent::__construct($source);
    }
}
