<?php

class Denkmal_Paging_Event_VenueDateIntervalTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $today = new DateTime();
        $tomorrow = clone $today;
        $tomorrow->add(new DateInterval('P1D'));

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $tomorrow);
        $event2->setHidden(true);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $tomorrow);

        $paging = new Denkmal_Paging_Event_VenueDateInterval($venue, $today, $tomorrow);
        $this->assertEquals(array($event1, $event3), $paging);
    }

    public function testGetItemsFuture() {
        $today = new DateTime();
        $tomorrow = clone $today;
        $tomorrow->add(new DateInterval('P1D'));
        $yesterday = clone $today;
        $yesterday->sub(new DateInterval('P1D'));

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $yesterday);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $tomorrow);

        $paging = new Denkmal_Paging_Event_VenueDateInterval($venue, $today);
        $this->assertEquals(array($event2, $event3), $paging);
    }

    public function testGetItemsPast() {
        $today = new DateTime();
        $tomorrow = clone $today;
        $tomorrow->add(new DateInterval('P1D'));
        $yesterday = clone $today;
        $yesterday->sub(new DateInterval('P1D'));

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $yesterday);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $tomorrow);

        $paging = new Denkmal_Paging_Event_VenueDateInterval($venue, null, $today);
        $this->assertEquals(array($event2, $event1), $paging);
    }

    public function testGetItemsExcludeEvents() {
        $today = new DateTime();

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);

        $paging = new Denkmal_Paging_Event_VenueDateInterval($venue, null, null, array($event2));
        $this->assertEquals(array($event1, $event3), $paging);
    }

    public function testGetItemsShowAll() {
        $today = new DateTime();

        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
        $event2->setHidden(true);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);

        $paging = new Denkmal_Paging_Event_VenueDateInterval($venue, null, null, null, true);
        $this->assertEquals(array($event1, $event2, $event3), $paging);
    }
}
