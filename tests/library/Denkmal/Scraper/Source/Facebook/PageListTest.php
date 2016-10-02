<?php

class Denkmal_Scraper_Source_Facebook_PageListTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRun() {
        $region = Denkmal_Model_Region::findBySlug('graz');
        $facebookPage = Denkmal_Model_FacebookPage::create('my-page-1', 'My page 1');
        (new Denkmal_Paging_FacebookPage_ListScraper($region))->add($facebookPage);

        $scraper = new Denkmal_Scraper_Source_Facebook_PageList();
        /** @var \Facebook\Facebook|\Mocka\AbstractClassTrait $facebookClient */
        $facebookClient = $this->mockClass('\Facebook\Facebook')->newInstanceWithoutConstructor();
        $facebookClient->mockMethod('get')->set(function ($endpoint) {
            $this->assertSame('/my-page-1/events?limit=9999', $endpoint);
            $request = new \Facebook\FacebookRequest();
            $body = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/ppc.json');
            return new \Facebook\FacebookResponse($request, $body);
        });
        $this->getServiceManager()->replaceInstance('facebook', $facebookClient);

        $eventDataList = $scraper->run([]);

        $this->assertCount(95, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $region,
            'p.p.c.',
            new Denkmal_Scraper_Description('KC Rebell Tour 2017 · 24.03. Ppc, Graz'),
            new DateTime('2017-03-24 20:00:00'),
            null,
            'facebook-page:my-page-1'
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $region,
            'p.p.c.',
            new Denkmal_Scraper_Description('Django 3000 - Im Sturm Tour 2017 - PPC'),
            new DateTime('2017-03-18 19:00:00'),
            new DateTime('2017-03-18 23:00:00'),
            'facebook-page:my-page-1'
        ), $eventDataList[1]);
    }
}
