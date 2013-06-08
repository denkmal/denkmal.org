<?php

class Denkmal_Paging_Venue_PublicTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
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
