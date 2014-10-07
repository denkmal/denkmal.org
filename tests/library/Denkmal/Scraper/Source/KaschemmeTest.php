<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Kaschemme')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(11))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('FC Basel 1893 - Liverpool FC'),
            new DateTime('2014-10-01 18:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Kaschemme SKANK w/ Echolt'),
            new DateTime('2014-10-03 22:00:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Gestern Nacht in der Kaschemme w/ Herzschwester & Thom Nagy'),
            new DateTime('2014-10-04 22:00:00')
        );

        /** @var Denkmal_Scraper_Source_Kaschemme $scraper */
        $scraper->processPage($html);
    }
}
