<?php

class Denkmal_Paging_Venue_PublicTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testGetItems() {
		$publicVenueB = Denkmal_Model_Venue::create(array('name' => 'public b', 'queued' => false, 'enabled' => true, 'hidden' => false));
		$publicVenueA = Denkmal_Model_Venue::create(array('name' => 'public a', 'queued' => false, 'enabled' => true, 'hidden' => false));
		Denkmal_Model_Venue::create(array('name' => 'private a', 'queued' => false, 'enabled' => true, 'hidden' => true));
		Denkmal_Model_Venue::create(array('name' => 'private b', 'queued' => false, 'enabled' => false, 'hidden' => false));
		$publicVenues = new Denkmal_Paging_Venue_Public();
		$this->assertEquals(array($publicVenueA, $publicVenueB), $publicVenues);
	}

	public function testVenueChange() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'foo', 'queued' => false, 'enabled' => true));
		$publicVenues = new Denkmal_Paging_Venue_Public();
		$this->assertCount(1, $publicVenues);
		$venue->setEnabled(false);
		$publicVenues = new Denkmal_Paging_Venue_Public();
		$this->assertCount(0, $publicVenues);
	}
}
