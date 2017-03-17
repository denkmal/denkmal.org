<?php

class Denkmal_Scraper_Source_Basel_ReneeTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessEvents() {
        $apiResponse = CM_Util::jsonDecode(Denkmal_Scraper_Source_Abstract::loadFile(DIR_TEST_DATA . 'scraper/basel/renee.json'));
        $scraper = new Denkmal_Scraper_Source_Basel_Renee();
        $eventDataList = $scraper->processEvents($apiResponse, new DateTime('2017-01-20'));

        $this->assertCount(2, $eventDataList);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Renée',
            new Denkmal_Scraper_Description('kj jhgjhgjhh Cool!'),
            new DateTime('2017-01-23 21:00:00')
        ), $eventDataList[0]);

        $this->assertEquals(new Denkmal_Scraper_EventData(
            $scraper->getRegion(),
            'Renée',
            new Denkmal_Scraper_Description('Hello World!'),
            new DateTime('2017-01-25 03:00:00')
        ), $eventDataList[1]);
    }
}
