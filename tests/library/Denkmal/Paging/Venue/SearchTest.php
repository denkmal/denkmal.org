<?php

class Denkmal_Paging_Venue_SearchTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue1 = Denkmal_Model_Venue::create('Foo 1', true, false);
        $venue2 = Denkmal_Model_Venue::create('Foo Bar 2', true, false);
        $venue3 = Denkmal_Model_Venue::create('Foo 3', true, false);
        Denkmal_Model_VenueAlias::create($venue3, 'Foo Bar 3');
        Denkmal_Model_VenueAlias::create($venue3, 'Foo Bar 3b');
        $venue4 = Denkmal_Model_Venue::create('Foo 4', true, false);

        $this->assertEquals(array($venue1, $venue3, $venue4, $venue2), new Denkmal_Paging_Venue_Search('foo'));
        $this->assertEquals(array($venue3, $venue2), new Denkmal_Paging_Venue_Search('bar'));
    }
}
