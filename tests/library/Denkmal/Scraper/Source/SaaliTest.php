<?php

class Denkmal_Scraper_Source_SaaliTest extends CMTest_TestCase {

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, 2015);

        $this->assertCount(9, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Solotundra (IT) Rock\'n\'Roll One Man Show CANCELED !!!'),
            new DateTime('2015-03-19 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Mr. Marble Puddle Stompers Downtown Blues'),
            new DateTime('2015-04-04 21:00:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Andi\'s Blues Orchester (DE) Blues / Boogie / Ragtime'),
            new DateTime('2015-04-17 21:00:00')
        ), $eventDataList[6]);
    }

    public function testProcessSummerBreak() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-summer.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, 2015);

        $this->assertCount(0, $eventDataList);
    }

    public function testProcessVersion2() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-2.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, 2015);

        $this->assertCount(3, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Quiz der Populärkultur Mit Mämä Sykora & Sascha Török'),
            new DateTime('2015-12-12 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Extrafish (LU) Winterfishtour Gipsy_Swing'),
            new DateTime('2015-12-17 21:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            'Sääli',
            new Denkmal_Scraper_Description('Starmachine (CH) Live Karaoke-Band'),
            new DateTime('2015-12-19 21:00:00')
        ), $eventDataList[2]);
    }
}
