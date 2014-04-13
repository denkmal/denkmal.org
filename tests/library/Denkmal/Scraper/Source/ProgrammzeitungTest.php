<?php

class Denkmal_Scraper_Source_ProgrammzeitungTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'programmzeitung.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Programmzeitung')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Guggenheim Liestal',
            new Denkmal_Scraper_Description('unplugged@mooi. Kollekte', 'Djinbala'),
            new DateTime('2013-03-13 19:00:00'),
            new DateTime('2013-03-13 22:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Kulturraum Marabu',
            new Denkmal_Scraper_Description('Regionale Pop- und Rockbands', '2. Marabu Rocknacht'),
            new DateTime('2013-03-13 19:15:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Querfeld-Halle',
            new Denkmal_Scraper_Description('Partytunes, Disco', 'Tanznacht 40'),
            new DateTime('2013-03-13 21:00:00')
        );
        $scraper->expects($this->at(3))->method('_addEventAndVenue')->with(
            'Kaserne Basel',
            new Denkmal_Scraper_Description('Worldmusic, Dub, HipHop, Gipsy', 'Balkan Beat Box (IL/US)'),
            new DateTime('2013-03-13 21:00:00')
        );
        /** @var Denkmal_Scraper_Source_Programmzeitung $scraper */

        $scraper->processPageDate($html, new DateTime('2013-03-13'));
    }
}
