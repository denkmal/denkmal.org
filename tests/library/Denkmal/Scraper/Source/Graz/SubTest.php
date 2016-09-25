<?php

class Denkmal_Scraper_Source_Graz_SubTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessPageDate() {
        $html = Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/graz/sub.txt');
        $scraper = new Denkmal_Scraper_Source_Graz_Sub();
        $eventDataList = $scraper->processPageDate($html, new DateTime('2016-09-26'));

        $this->assertCount(111, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'SUb',
            new Denkmal_Scraper_Description('Unhappy Birthday (Post Punk / GER), Baby Galaxy (Indie Rock / NED), Heim (GER), Andalucia (GER)', 'Memento Mori Booking presents'),
            new DateTime('2016-09-28 21:00:00')
        ), $eventDataList[101]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'SUb',
            new Denkmal_Scraper_Description('Schünd (Punk / AT), Republic Of Waste (HC-Punk / AT), Pervy Pissheads (Weirdo / AT), Human Behavior (HC, Sludge / AT)'),
            new DateTime('2016-09-30 21:00:00')
        ), $eventDataList[107]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'SUb',
            new Denkmal_Scraper_Description('Neon Lies (Synth Wave/Cold Wave / CRO), Cult Values (dark- frantic-tPost Punk / GER), Red Gaze (Punk/Post Punk / AUT)', 'in case of doubt presents Marian'),
            new DateTime('2016-10-05 21:00:00')
        ), $eventDataList[105]);
    }
}
