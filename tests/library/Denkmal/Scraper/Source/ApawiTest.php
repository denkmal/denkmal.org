<?php

class Denkmal_Scraper_Source_ApawiTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/apawi.xml');
        $scraper = new Denkmal_Scraper_Source_Apawi();
        $eventDataList = $scraper->processPageDate($html, new DateTime('2016-04-24'));

        $this->assertCount(14, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Apawi',
            new Denkmal_Scraper_Description('Karaoke: EuropAsiaExpress BBbox', null, new Denkmal_Scraper_Genres('Karaoke')),
            new DateTime('2016-04-26 18:00:00'),
            new DateTime('2016-04-27 01:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Apawi',
            new Denkmal_Scraper_Description('Gastroparty - alles liegen lassen', null, new Denkmal_Scraper_Genres('House, Pop, Funk & RnB')),
            new DateTime('2016-06-05 18:00:00'),
            new DateTime('2016-06-06 01:00:00')
        ), $eventDataList[13]);
    }
}
