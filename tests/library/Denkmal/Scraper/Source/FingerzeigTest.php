<?php

class Denkmal_Scraper_Source_FingerzeigTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/fingerzeig.html');
        $scraper = new Denkmal_Scraper_Source_Fingerzeig();

        $eventDataList = $scraper->processPageDate($html, new DateTime('2014-04-23'));

        $this->assertCount(3, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaserne',
            new Denkmal_Scraper_Description('The bianca Story «Gilgamesh Must Die!»', null, new Denkmal_Scraper_Genres('konzert, theater')),
            new DateTime('2014-04-23 20:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Jägerhalle',
            new Denkmal_Scraper_Description('Lindy Hop Hot Club', null, new Denkmal_Scraper_Genres('swing')),
            new DateTime('2014-04-23 20:30:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Balz Bar',
            new Denkmal_Scraper_Description('Balz – wolf+lamb', null, new Denkmal_Scraper_Genres('electro, house')),
            new DateTime('2014-04-23 22:00:00')
        ), $eventDataList[2]);
    }
}
