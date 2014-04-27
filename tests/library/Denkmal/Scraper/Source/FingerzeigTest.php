<?php

class Denkmal_Scraper_Source_FingerzeigTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/fingerzeig.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Fingerzeig')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(3))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Kaserne',
            new Denkmal_Scraper_Description('The bianca Story «Gilgamesh Must Die!»', null, new Denkmal_Scraper_Genres('konzert, theater')),
            new DateTime('2014-04-23 20:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Jägerhalle',
            new Denkmal_Scraper_Description('Lindy Hop Hot Club', null, new Denkmal_Scraper_Genres('swing')),
            new DateTime('2014-04-23 20:30:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Balz Bar',
            new Denkmal_Scraper_Description('Balz – wolf+lamb', null, new Denkmal_Scraper_Genres('electro, house')),
            new DateTime('2014-04-23 22:00:00')
        );
        /** @var Denkmal_Scraper_Source_Programmzeitung $scraper */

        $scraper->processPageDate($html, new DateTime('2014-04-23'));
    }
}
