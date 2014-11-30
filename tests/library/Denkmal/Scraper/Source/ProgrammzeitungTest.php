<?php

class Denkmal_Scraper_Source_ProgrammzeitungTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/programmzeitung.html');
        $manager = new Denkmal_Scraper_Manager();
        $scraper = new Denkmal_Scraper_Source_Programmzeitung($manager);

        $eventDataList = $scraper->processPageDate($html, new DateTime('2014-11-16'));

        $this->assertCount(6, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Guggenheim Liestal',
            new Denkmal_Scraper_Description('unplugged@mooi. Singer/Songwriter. Oliver Blessinger (g, voc), Marco Brander (dr), Andy Lehmann (b). Kollekte', 'Oliver Blessinger'),
            new DateTime('2014-11-16 13:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Volkshaus Basel',
            new Denkmal_Scraper_Description('Mundartpop', 'Schwiizergoofe'),
            new DateTime('2014-11-16 13:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Tango Schule Basel',
            new Denkmal_Scraper_Description('(Clarahof) - DJ Sopee Jaa', 'La TangoCita'),
            new DateTime('2014-11-16 16:00:00'),
            new DateTime('2014-11-16 19:30:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sud',
            new Denkmal_Scraper_Description('Voice and Sound Improvisation (der Oberton-Sängerin, Klang- und Performancekünstlerin, Dichterin aus Südsibirien). Festival-Programm: www.butoh-off.com', 'Butoh-Festival 2014: Sainkho Namtchylak'),
            new DateTime('2014-11-16 20:00:00')
        ), $eventDataList[3]);
    }
}
