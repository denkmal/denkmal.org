<?php

class Denkmal_Paging_FacebookPage_ListScraperTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $region1 = DenkmalTest_TH::createRegion();
        $region2 = DenkmalTest_TH::createRegion();

        $facebookPage1 = Denkmal_Model_FacebookPage::create('page-1', 'Page 1');
        $facebookPage2 = Denkmal_Model_FacebookPage::create('page-2', 'Page 2');
        $facebookPage3 = Denkmal_Model_FacebookPage::create('page-3', 'Page 3');

        (new Denkmal_Paging_FacebookPage_ListScraper($region1))->add($facebookPage1);
        (new Denkmal_Paging_FacebookPage_ListScraper($region1))->add($facebookPage2);
        (new Denkmal_Paging_FacebookPage_ListScraper($region2))->add($facebookPage3);

        $this->assertEquals([$facebookPage1, $facebookPage2], new Denkmal_Paging_FacebookPage_ListScraper($region1));
        $this->assertEquals([$facebookPage3], new Denkmal_Paging_FacebookPage_ListScraper($region2));

        (new Denkmal_Paging_FacebookPage_ListScraper($region1))->remove($facebookPage1);
        $this->assertEquals([$facebookPage2], new Denkmal_Paging_FacebookPage_ListScraper($region1));
    }

}
