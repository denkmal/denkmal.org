<?php

class Denkmal_Scraper_Source_HinterhofTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/hinterhof.html');
        $scraper = new Denkmal_Scraper_Source_Hinterhof();

        $eventDataList = $scraper->processPage($html, new DateTime('2014-04-01'));

        $this->assertCount(24, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hinterhof',
            new Denkmal_Scraper_Description('Hinterhof Slam', null, new Denkmal_Scraper_Genres('slam poetry, whiskey grooves')),
            new DateTime('2014-04-17 20:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hinterhof',
            new Denkmal_Scraper_Description('The Correspondents | Live', 'Bandura & Hinterhof “Bitten zum” Tanz', new Denkmal_Scraper_Genres('funk beats, swing hop, world grooves')),
            new DateTime('2014-04-17 20:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hinterhof Dachterrasse',
            new Denkmal_Scraper_Description('Dachterasse geöffnet'),
            new DateTime('2014-05-07 20:00:00')
        ), $eventDataList[13]);
    }
}
