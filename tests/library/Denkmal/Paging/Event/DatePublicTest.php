<?php

class Denkmal_Paging_Event_DateTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testGetItems() {
		$today = new DateTime();
		$today->setTime(20, 0, 0);

		$venue = Denkmal_Model_Venue::create('Foo', true, false);
		$event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
		$event1->setHidden(true);
		$event2 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, $today);
		$event3 = Denkmal_Model_Event::create($venue, 'Foo 1', false, false, $today);

		$paging = new Denkmal_Paging_Event_Date($today);
		$this->assertEquals(array($event2), $paging);

	}
}
