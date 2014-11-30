<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');
        $manager = new Denkmal_Scraper_Manager();
        $scraper = new Denkmal_Scraper_Source_Kaschemme($manager);

        $eventDataList = $scraper->processPage($html);

        $this->assertCount(9, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('w/ Echolot Dub System & Bless HIM Select', 'Kaschemme Skank', new Denkmal_Scraper_Genres('Dub, Roots, Reggae')),
            new DateTime('2014-11-07 22:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Dirty 30 feat. Zest & Herzschwester', null, new Denkmal_Scraper_Genres('80’s till Electronica')),
            new DateTime('2014-11-14 22:00:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('w/ Marcel Vogel & The Name Game', 'Lumberjack in Hell', new Denkmal_Scraper_Genres('Cosmic Funk')),
            new DateTime('2014-11-15 22:00:00')
        ), $eventDataList[3]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('FC Basel – Real Madrid'),
            new DateTime('2014-11-26 22:00:00')
        ), $eventDataList[6]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Julien Lebrun (Hot Casa Records, Paris), Alma Negra (Sofrito)', 'Alma Negra', new Denkmal_Scraper_Genres('Afrobeat/Tribal')),
            new DateTime('2014-11-28 22:00:00')
        ), $eventDataList[7]);
    }
}
