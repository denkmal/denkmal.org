<?php

class Denkmal_Paging_Venue_GeoPointTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue1 = DenkmalTest_TH::createVenue('Foo 1', false, false, null, null, null, new CM_Geo_Point(47.554615, 7.59446));
        $venue2 = DenkmalTest_TH::createVenue('Foo 2', false, false, null, null, null, new CM_Geo_Point(47.5526076, 7.572782));
        $venue3 = DenkmalTest_TH::createVenue('Foo 3', false, false, null, null, null, new CM_Geo_Point(47.5526076, 7.572782));
        $venue3->setSuspended(true);
        DenkmalTest_TH::createVenue('Foo 4', false, false, null, null, null, new CM_Geo_Point(47.4700548, 7.6924664));

        $paging = new Denkmal_Paging_Venue_GeoPoint(new CM_Geo_Point(47.554615, 7.5944599), 3000);
        $this->assertEquals(array($venue1, $venue2), $paging);
    }
}
