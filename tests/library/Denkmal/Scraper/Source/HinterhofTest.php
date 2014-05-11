<?php

class Denkmal_Scraper_Source_HinterhofTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/hinterhof.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Hinterhof')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(24))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Hinterhof',
            new Denkmal_Scraper_Description('Hinterhof Slam', null, new Denkmal_Scraper_Genres('slam poetry, whiskey grooves')),
            new DateTime('2014-04-17 20:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Hinterhof',
            new Denkmal_Scraper_Description('The Correspondents | Live', 'Bandura & Hinterhof “Bitten zum” Tanz', new Denkmal_Scraper_Genres('funk beats, swing hop, world grooves')),
            new DateTime('2014-04-17 20:00:00')
        );
        $scraper->expects($this->at(13))->method('_addEventAndVenue')->with(
            'Hinterhof Dachterrasse',
            new Denkmal_Scraper_Description('Dachterasse geöffnet'),
            new DateTime('2014-05-07 20:00:00')
        );

        /** @var Denkmal_Scraper_Source_Hinterhof $scraper */
        $scraper->processPage($html);
    }
}
