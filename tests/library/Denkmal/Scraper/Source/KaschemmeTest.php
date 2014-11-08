<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Kaschemme')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(9))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('w/ Echolot Dub System & Bless HIM Select', 'Kaschemme Skank', new Denkmal_Scraper_Genres('Dub, Roots, Reggae')),
            new DateTime('2014-11-07 22:00:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Dirty 30 feat. Zest & Herzschwester', null, new Denkmal_Scraper_Genres('80’s till Electronica')),
            new DateTime('2014-11-14 22:00:00')
        );
        $scraper->expects($this->at(3))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('w/ Marcel Vogel & The Name Game', 'Lumberjack in Hell', new Denkmal_Scraper_Genres('Cosmic Funk')),
            new DateTime('2014-11-15 22:00:00')
        );
        $scraper->expects($this->at(6))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('FC Basel – Real Madrid'),
            new DateTime('2014-11-26 22:00:00')
        );
        $scraper->expects($this->at(7))->method('_addEventAndVenue')->with(
            'Kaschemme',
            new Denkmal_Scraper_Description('Julien Lebrun (Hot Casa Records, Paris), Alma Negra (Sofrito)', 'Alma Negra', new Denkmal_Scraper_Genres('Afrobeat/Tribal')),
            new DateTime('2014-11-28 22:00:00')
        );

        /** @var Denkmal_Scraper_Source_Kaschemme $scraper */
        $scraper->processPage($html);
    }
}
