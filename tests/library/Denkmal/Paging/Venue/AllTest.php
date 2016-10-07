<?php

class Denkmal_Paging_Venue_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $region1 = DenkmalTest_TH::createRegion();
        $region2 = DenkmalTest_TH::createRegion();

        $venue1 = DenkmalTest_TH::createVenue('Venue 1', null, null, $region1);
        $venue2 = DenkmalTest_TH::createVenue('Venue 2', null, null, $region2);
        $venue3 = DenkmalTest_TH::createVenue('Venue 3', null, null, $region1);
        $venue4 = DenkmalTest_TH::createVenue('Venue 4', null, null, $region1);

        $this->assertEquals([$venue1, $venue2, $venue3, $venue4], new Denkmal_Paging_Venue_All());
        $this->assertEquals([$venue1, $venue2, $venue3, $venue4], new Denkmal_Paging_Venue_All(null, true));
        $this->assertEquals([$venue1, $venue3, $venue4], new Denkmal_Paging_Venue_All($region1));
        $this->assertEquals([$venue1, $venue3, $venue4], new Denkmal_Paging_Venue_All($region1, true));

        $venue3->setSuspended(true);
        $venue4->setIgnore(true);

        $this->assertEquals([$venue1, $venue2], new Denkmal_Paging_Venue_All());
        $this->assertEquals([$venue1, $venue2, $venue3, $venue4], new Denkmal_Paging_Venue_All(null, true));
        $this->assertEquals([$venue1], new Denkmal_Paging_Venue_All($region1));
        $this->assertEquals([$venue1, $venue3, $venue4], new Denkmal_Paging_Venue_All($region1, true));
    }

}
