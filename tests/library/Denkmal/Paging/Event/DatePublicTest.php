<?php

class Denkmal_Paging_Event_DateTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $today = new DateTime();
        $today->setTime(20, 0, 0);

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event1->setHidden(true);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', false, false, $today);

        $paging = new Denkmal_Paging_Event_Date($today);
        $this->assertEquals(array($event2), $paging);
    }

    public function testGetItemsVenueNameOrdering() {
        $today = new DateTime();
        $today->setTime(20, 0, 0);

        $venue1 = DenkmalTest_TH::createVenue('A');
        $venue2 = DenkmalTest_TH::createVenue('B');

        $event1 = Denkmal_Model_Event::create($venue1, 'Foo 1', true, false, $today);
        $event2 = Denkmal_Model_Event::create($venue2, 'Foo 1', true, false, $today);

        $paging = new Denkmal_Paging_Event_Date($today);
        $this->assertEquals(array($event1, $event2), $paging);
    }
}
