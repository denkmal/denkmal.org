<?php

class Denkmal_Scraper_Source_HinterhofTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/hinterhof.html');
        $scraper = new Denkmal_Scraper_Source_Hinterhof();

        $eventDataList = $scraper->processPage($html, 2014);

        $this->assertCount(24, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Hinterhof',
            new Denkmal_Scraper_Description('Hinterhof Slam', null, new Denkmal_Scraper_Genres('slam poetry, whiskey grooves')),
            new DateTime('2014-04-17 20:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Hinterhof',
            new Denkmal_Scraper_Description('The Correspondents | Live', 'Bandura & Hinterhof “Bitten zum” Tanz', new Denkmal_Scraper_Genres('funk beats, swing hop, world grooves')),
            new DateTime('2014-04-17 20:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Hinterhof Dachterrasse',
            new Denkmal_Scraper_Description('Dachterasse geöffnet'),
            new DateTime('2014-05-07 20:00:00')
        ), $eventDataList[13]);
    }
}
