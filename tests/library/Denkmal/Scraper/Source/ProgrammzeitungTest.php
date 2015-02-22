<?php

class Denkmal_Scraper_Source_ProgrammzeitungTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/programmzeitung.html');
        $scraper = new Denkmal_Scraper_Source_Programmzeitung();

        $eventDataList = $scraper->processPageDate($html, new DateTime('2015-02-22'));

        $this->assertCount(5, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Soliparty (Bar 18.00 - durchgehend DJs)', 'Uferlos in der Kaschemme'),
            new DateTime('2015-02-22 18:00:00')
        ), $eventDataList[0]);
    }
}
