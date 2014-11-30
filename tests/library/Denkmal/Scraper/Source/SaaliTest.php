<?php

class Denkmal_Scraper_Source_SaaliTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, 2014);

        $this->assertCount(9, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Monoglot (CH) Jazz'),
            new DateTime('2014-11-20 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('The Roarings 420s (DE) & The Blank Tapes (US) Psychedelic,Surf,Garage'),
            new DateTime('2014-11-28 21:00:00')
        ), $eventDataList[3]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('The Rebel Sperm (CH) One–Women–Show–By Jackie Brutsche'),
            new DateTime('2014-12-12 21:00:00')
        ), $eventDataList[8]);
    }
}
