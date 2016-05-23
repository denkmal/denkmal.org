<?php

class Denkmal_Paging_Venue_SearchTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue1 = DenkmalTest_TH::createVenue('Foo 1');
        $venue2 = DenkmalTest_TH::createVenue('Foo Bar 2');
        $venue3 = DenkmalTest_TH::createVenue('Foo 3');
        Denkmal_Model_VenueAlias::create($venue3, 'Foo Bar 3');
        Denkmal_Model_VenueAlias::create($venue3, 'Foo Bar 3b');
        $venue4 = DenkmalTest_TH::createVenue('Foo 4');

        $this->assertEquals(array($venue1, $venue3, $venue4, $venue2), new Denkmal_Paging_Venue_Search('foo'));
        $this->assertEquals(array($venue3, $venue2), new Denkmal_Paging_Venue_Search('bar'));
    }
}
