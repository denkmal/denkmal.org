<?php

class Denkmal_Scraper_Source_ProgrammzeitungTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'programmzeitung.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Programmzeitung')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Djinbala',
            ' unplugged@mooi. Kollekte ',
            new DateTime('2013-03-13 19:00:00'),
            new DateTime('2013-03-13 22:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            '2. Marabu Rocknacht ',
            ' Regionale Pop- und Rockbands ',
            new DateTime('2013-03-13 19:15:00')
        );
        /** @var Denkmal_Scraper_Source_Programmzeitung $scraper */

        $scraper->processPageDate($html, new DateTime('2013-03-13'));
    }
}
