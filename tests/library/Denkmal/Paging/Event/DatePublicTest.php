<?php

class Denkmal_Paging_Event_DateTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testGetItems() {
		$today = new DateTime();
		$today->setTime(20, 0, 0);
		$past = clone $today;
		$past->sub(new DateInterval('P2D'));
		$future = clone $today;
		$future->add(new DateInterval('P2D'));

		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Foo', 'queued' => false, 'enabled' => true));
		$event1 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 1', 'from' => $future, 'queued' => false, 'enabled' => true, 'hidden' => false));
		$event2 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 2', 'from' => $past, 'queued' => false, 'enabled' => true, 'hidden' => false));
		$event3 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 3', 'from' => $today, 'queued' => false, 'enabled' => true, 'hidden' => false));

		$paging = new Denkmal_Paging_Event_Date($today);
		$this->assertEquals(array($event3), $paging);
	}

	public function testGetItemsPublic() {
		$today = new DateTime();
		$today->setTime(20, 0, 0);

		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Foo', 'queued' => false, 'enabled' => true));
		$event1 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 1', 'from' => $today, 'queued' => false, 'enabled' => true, 'hidden' => true));
		$event2 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 2', 'from' => $today, 'queued' => false, 'enabled' => true, 'hidden' => false));
		$event3 = Denkmal_Model_Event::createStatic(
			array('venue' => $venue, 'description' => 'Foo 3', 'from' => $today, 'queued' => false, 'enabled' => false, 'hidden' => false));

		$paging = new Denkmal_Paging_Event_Date($today, true);
		$this->assertEquals(array($event2), $paging);

	}
}
