<?php

class Denkmal_Scraper_Source_SaaliTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2015-04-01'));

        $this->assertCount(9, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Solotundra (IT) Rock\'n\'Roll One Man Show CANCELED !!!'),
            new DateTime('2015-03-19 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Mr. Marble Puddle Stompers Downtown Blues'),
            new DateTime('2015-04-04 21:00:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Andi\'s Blues Orchester (DE) Blues / Boogie / Ragtime'),
            new DateTime('2015-04-17 21:00:00')
        ), $eventDataList[6]);
    }

    public function testProcessSummerBreak() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-summer.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2015-04-01'));

        $this->assertCount(0, $eventDataList);
    }

    public function testProcessVersion2() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-2.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2015-04-01'));

        $this->assertCount(3, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Quiz der Populärkultur Mit Mämä Sykora & Sascha Török'),
            new DateTime('2015-12-12 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Extrafish (LU) Winterfishtour Gipsy_Swing'),
            new DateTime('2015-12-17 21:00:00')
        ), $eventDataList[1]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Starmachine (CH) Live Karaoke-Band'),
            new DateTime('2015-12-19 21:00:00')
        ), $eventDataList[2]);
    }

    public function testProcessVersion3() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-3.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2015-04-01'));

        $this->assertCount(6, $eventDataList);
    }

    public function testProcessVersion4() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-4.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2016-03-01'));

        $this->assertCount(5, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('EUROPA (CH) Die neue Leichtigkeit'),
            new DateTime('2016-03-31 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Live: Danny & The Two Toms (CH) Rock\'n\'Roll anschliessend DJ by RRC'),
            new DateTime('2016-04-08 22:00:00')
        ), $eventDataList[2]);
    }

    public function testProcessVersion5() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-5.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2016-09-18'));

        $this->assertCount(6, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Jallimann & Rootspro Calypso, Mento, Cumbia, Ska, Latin and Afro from 1930 to present', 'Rumba Boxx'),
            new DateTime('2016-09-16 22:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('John Eastwood Dark 80\'s'),
            new DateTime('2016-09-17 22:00:00')
        ), $eventDataList[1]);
    }

    public function testProcessVersion6() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-6.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2016-10-15'));

        $this->assertCount(10, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('DJ John Easdtwood Dark 80\'s'),
            new DateTime('2016-10-07 22:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('DJ Curtis, Mick & Ziggi Stardust Psychedelic, 60\'s, Beat, Garage', 'Shabbytunes'),
            new DateTime('2016-10-08 22:00:00')
        ), $eventDataList[1]);
    }

    public function testProcessVersion7() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/saali-7.html');
        $scraper = new Denkmal_Scraper_Source_Saali();

        $eventDataList = $scraper->processPage($html, new DateTime('2017-01-01'));

        $this->assertCount(14, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Shatafa, Phil Battiekh Arab 60s 70s, sha3byton', 'Sharmuta Shake'),
            new DateTime('2017-01-06 22:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('Isn\'t Friday?'),
            new DateTime('2017-01-12 20:00:00')
        ), $eventDataList[2]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Sääli',
            new Denkmal_Scraper_Description('John Eastwood Dark 80\'', 'Easy Dust'),
            new DateTime('2017-01-13 20:00:00')
        ), $eventDataList[3]);
    }
}
