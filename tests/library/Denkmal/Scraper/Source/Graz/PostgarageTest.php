<?php

class Denkmal_Scraper_Source_Graz_PostgarageTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/graz/postgarage.xml');
        $scraper = new Denkmal_Scraper_Source_Graz_Postgarage();
        $eventDataList = $scraper->processPageDate($html, new DateTime('2016-09-26'));

        $this->assertCount(20, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Postgarage',
            new Denkmal_Scraper_Description('Grieskram Musikpark & Aftershow Party', null, new Denkmal_Scraper_Genres('Nachbarschaftsfest Gries')),
            new DateTime('2016-09-24 22:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Postgarage',
            new Denkmal_Scraper_Description('Bernhard Schimpelsberger & Georg Gratzer - Rhythm Diaries', null, new Denkmal_Scraper_Genres('Konzert')),
            new DateTime('2016-09-29 20:00:00')
        ), $eventDataList[2]);
    }
}
