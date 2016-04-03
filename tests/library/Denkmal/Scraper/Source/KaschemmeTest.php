<?php

class Denkmal_Scraper_Source_KaschemmeTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/kaschemme.html');
        $scraper = new Denkmal_Scraper_Source_Kaschemme();

        $eventDataList = $scraper->processPage($html, new DateTime('2015-02-01'));

        $this->assertCount(21, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Ça Claque w/ Kack Musikk (Global Ghetto Anthems, Lu), Luk Le Chuk (Lu), B.O.M (ça claque), Lord Soft (ça claque)', null, new Denkmal_Scraper_Genres('UK Bass, Trap, Footwork')),
            new DateTime('2015-02-20 22:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Akiwawa w/ Pun & Rainer', null, new Denkmal_Scraper_Genres('Afro Beats & Rare Grooves')),
            new DateTime('2015-02-21 22:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Uferlos in der Kaschemme, Soliparty', null, null),
            new DateTime('2015-02-22 22:00:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Kaschemme',
            new Denkmal_Scraper_Description('Afu-Ra (NYC, USA), Support: K.W.A.T aka Kush, Krime, Levo, Dj Freak (Zitral)', null, new Denkmal_Scraper_Genres('Rap')),
            new DateTime('2015-02-27 22:00:00')
        ), $eventDataList[3]);
    }
}
