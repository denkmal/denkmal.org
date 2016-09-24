<?php

class Denkmal_Scraper_Source_FacebookTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $region = Denkmal_Model_Region::findBySlug('graz');
        $venue1 = DenkmalTest_TH::createVenue('My Venue 1', null, null, $region);
        $venue1->setFacebookPageId('my-page-1');
        $venue2 = DenkmalTest_TH::createVenue('My Venue 2', null, null, $region);
        $venueList = [$venue1, $venue2];

        $scraper = new Denkmal_Scraper_Source_Facebook();
        /** @var \Facebook\Facebook|\Mocka\AbstractClassTrait $facebookClient */
        $facebookClient = $this->mockClass('\Facebook\Facebook')->newInstanceWithoutConstructor();
        $facebookClient->mockMethod('get')->set(function ($endpoint) {
            $this->assertSame('/my-page-1/events?limit=9999', $endpoint);
            $request = new \Facebook\FacebookRequest();
            $body = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/ppc.json');
            return new \Facebook\FacebookResponse($request, $body);
        });

        $eventDataList = $scraper->processVenueList($venueList, $facebookClient);

        $this->assertCount(99, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $region,
            'p.p.c.',
            new Denkmal_Scraper_Description('KC Rebell Tour 2017 · 24.03. Ppc, Graz'),
            new DateTime('2017-03-24 20:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $region,
            'p.p.c.',
            new Denkmal_Scraper_Description('Django 3000 - Im Sturm Tour 2017 - PPC'),
            new DateTime('2017-03-18 19:00:00'),
            new DateTime('2017-03-18 23:00:00')
        ), $eventDataList[1]);
    }
}
