<?php

class Denkmal_Model_VenueAliasTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$venueAlias = Denkmal_Model_VenueAlias::create(array('name' => 'Foo', 'venue' => $venue));

		$this->assertSame('Foo', $venueAlias->getName());
		$this->assertEquals($venue, $venueAlias->getVenue());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$venueAlias = Denkmal_Model_VenueAlias::create(array('name' => 'Foo', 'venue' => $venue));
		$venueAlias->delete();

		new Denkmal_Model_VenueAlias($venueAlias->getId());
	}
}
