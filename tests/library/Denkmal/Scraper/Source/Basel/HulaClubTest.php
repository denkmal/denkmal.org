<?php

class Denkmal_Scraper_Source_Basel_HulaClubTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessEvents() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/basel/hula-club.html');
        $scraper = new Denkmal_Scraper_Source_Basel_HulaClub();
        $eventDataList = $scraper->processPage($html, new DateTime('2017-05-28'));

        $this->assertCount(15, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hula Club',
            new Denkmal_Scraper_Description('Neu ! Harlem Sound', null, new Denkmal_Scraper_Genres('Jazz')),
            new DateTime('2017-04-25 19:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hula Club',
            new Denkmal_Scraper_Description('Tiki Bar', null, new Denkmal_Scraper_Genres('Hula Hawaiian Jukebox')),
            new DateTime('2017-04-28 19:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Hula Club',
            new Denkmal_Scraper_Description('His Masters Choice / Quintett', null, new Denkmal_Scraper_Genres('New Orleans Jazz')),
            new DateTime('2017-10-31 19:00:00')
        ), $eventDataList[11]);
    }
}
