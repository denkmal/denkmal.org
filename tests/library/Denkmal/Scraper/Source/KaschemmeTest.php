<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');
        $scraper = new Denkmal_Scraper_Source_Kaschemme();

        $eventDataList = $scraper->processPage($html, new DateTime('2016-10-26'));

        $this->assertCount(15, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Kaschemme',
            new Denkmal_Scraper_Description('Reelmusic Spotlight, w/ Hathors, The Clive, Pedro Lehmann', null, new Denkmal_Scraper_Genres('Rock ‘n’ Roll')),
            new DateTime('2016-10-27 20:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Kaschemme',
            new Denkmal_Scraper_Description('Ragga Twins (UK // London), QBIG & Zenith B (Flexout), Uncle Ed (ET*Mothership), Tomi (ET*Mothership), Jesse Da Killah (Raubfish Crew)', null, new Denkmal_Scraper_Genres('Drum’n’Bass, Jungle')),
            new DateTime('2016-10-28 20:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Kaschemme',
            new Denkmal_Scraper_Description('Rockin’ Fucking Halloween w/ King Legba & The Loas (Voodoo Undead Rock’n’Roll) & Denner Clan (Live at Kaschemme Album Release), Horrortanz mit DJ Johnny Bravo', null, new Denkmal_Scraper_Genres('Rock’n’Roll till Death')),
            new DateTime('2016-10-29 21:30:00')
        ), $eventDataList[2]);
    }
}
