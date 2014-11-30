<?php

class Denkmal_Scraper_Source_SaaliTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Saali')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(9))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Sääli',
            new Denkmal_Scraper_Description('Monoglot (CH) Jazz'),
            new DateTime('2014-11-20 21:00:00')
        );
        $scraper->expects($this->at(3))->method('_addEventAndVenue')->with(
            'Sääli',
            new Denkmal_Scraper_Description('The Roarings 420s (DE) & The Blank Tapes (US) Psychedelic,Surf,Garage'),
            new DateTime('2014-11-28 21:00:00')
        );
        $scraper->expects($this->at(8))->method('_addEventAndVenue')->with(
            'Sääli',
            new Denkmal_Scraper_Description('The Rebel Sperm (CH) One–Women–Show–By Jackie Brutsche'),
            new DateTime('2014-12-12 21:00:00')
        );

        /** @var Denkmal_Scraper_Source_Saali $scraper */
        $scraper->processPage($html, '2014');
    }
}
