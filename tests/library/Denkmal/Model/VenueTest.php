<?php

class Denkmal_Model_VenueTest extends CMTest_TestCase {

	public function testCreate() {
		$venue = Denkmal_Model_Venue::create(array(
			'name' => 'Example',
			'queued' => true,
			'enabled' => false,
		));

		$this->assertInstanceOf('Denkmal_Model_Venue', $venue);
	}
}
