<?php

class Denkmal_Paging_Event_DatePublicTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testGetItems() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Foo', 'queued' => false, 'enabled' => true));
		$event1 = Denkmal_Model_Event::create(
			array('venue' => $venue, 'description' => 'Foo 1', 'from' => 123, 'queued' => false, 'enabled' => true, 'hidden' => false));
		$event2 = Denkmal_Model_Event::create(
			array('venue' => $venue, 'description' => 'Foo 2', 'from' => 123, 'queued' => false, 'enabled' => true, 'hidden' => false));
		$event3 = Denkmal_Model_Event::create(
			array('venue' => $venue, 'description' => 'Foo 3', 'from' => 123, 'queued' => false, 'enabled' => true, 'hidden' => false));

		$paging = new Denkmal_Paging_Event_DatePublic();
		$this->assertEquals(array($event1, $event2, $event3), $paging);
	}
}
