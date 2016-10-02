<?php

use function Functional\flatten;
use function Functional\map;
use function Functional\reject;

class Denkmal_Scraper_Source_Facebook_PageList extends Denkmal_Scraper_Source_Facebook_Abstract {

    public function run(array $dateList) {
        /** @var Denkmal_Model_Region[] $regionList */
        $regionList = (new Denkmal_Paging_Region_All())->getItems();

        return flatten(map($regionList, function (Denkmal_Model_Region $region) {
            /** @var Denkmal_Model_FacebookPage[] $facebookPageList */
            $facebookPageList = (new Denkmal_Paging_FacebookPage_ListScraper($region))->getItems();
            return map($facebookPageList, function (Denkmal_Model_FacebookPage $facebookPage) use ($region) {
                return $this->_processFacebookPage($facebookPage, $region);
            });
        }));
    }

}
