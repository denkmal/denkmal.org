<?php

class Denkmal_Scraper_Source_ProgrammzeitungTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/programmzeitung.html');

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Programmzeitung')->setMethods(array('_addEventAndVenue'))->getMock();
        $scraper->expects($this->exactly(6))->method('_addEventAndVenue');
        $scraper->expects($this->at(0))->method('_addEventAndVenue')->with(
            'Guggenheim Liestal',
            new Denkmal_Scraper_Description('unplugged@mooi. Singer/Songwriter. Oliver Blessinger (g, voc), Marco Brander (dr), Andy Lehmann (b). Kollekte', 'Oliver Blessinger'),
            new DateTime('2014-11-16 13:00:00')
        );
        $scraper->expects($this->at(1))->method('_addEventAndVenue')->with(
            'Volkshaus Basel',
            new Denkmal_Scraper_Description('Mundartpop', 'Schwiizergoofe'),
            new DateTime('2014-11-16 13:00:00')
        );
        $scraper->expects($this->at(2))->method('_addEventAndVenue')->with(
            'Tango Schule Basel',
            new Denkmal_Scraper_Description('(Clarahof) - DJ Sopee Jaa', 'La TangoCita'),
            new DateTime('2014-11-16 16:00:00'),
            new DateTime('2014-11-16 19:30:00')
        );
        $scraper->expects($this->at(3))->method('_addEventAndVenue')->with(
            'Sud',
            new Denkmal_Scraper_Description('Voice and Sound Improvisation (der Oberton-Sängerin, Klang- und Performancekünstlerin, Dichterin aus Südsibirien). Festival-Programm: www.butoh-off.com', 'Butoh-Festival 2014: Sainkho Namtchylak'),
            new DateTime('2014-11-16 20:00:00')
        );
        /** @var Denkmal_Scraper_Source_Programmzeitung $scraper */

        $scraper->processPageDate($html, new DateTime('2014-11-16'));
    }
}
