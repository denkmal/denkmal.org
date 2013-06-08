<?php

class Denkmal_Model_VenueTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));

		$this->assertSame('Example', $venue->getName());
		$this->assertSame(null, $venue->getAddress());
		$this->assertSame(null, $venue->getLatitude());
		$this->assertSame(null, $venue->getLongitude());
		$this->assertSame(true, $venue->getQueued());
		$this->assertSame(false, $venue->getEnabled());
		$this->assertSame(false, $venue->getHidden());
	}

	public function testGetSetName() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Foo', 'queued' => true, 'enabled' => false));
		$this->assertSame('Foo', $venue->getName());

		$venue->setName('Bar');
		$this->assertSame('Bar', $venue->getName());
	}

	public function testGetSetAddress() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false, 'address' => 'Foo'));
		$this->assertSame('Foo', $venue->getAddress());

		$venue->setAddress('Bar');
		$this->assertSame('Bar', $venue->getAddress());
	}

	public function testGetSetLatitude() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false, 'latitude' => '23.5'));
		$this->assertSame(23.5, $venue->getLatitude());

		$venue->setLatitude(null);
		$this->assertSame(null, $venue->getLatitude());

		$venue->setLatitude(14.2);
		$this->assertSame(14.2, $venue->getLatitude());
	}

	public function testGetSetLongitude() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false, 'longitude' => '23.5'));
		$this->assertSame(23.5, $venue->getLongitude());

		$venue->setLongitude(null);
		$this->assertSame(null, $venue->getLongitude());

		$venue->setLongitude(14.2);
		$this->assertSame(14.2, $venue->getLongitude());
	}

	public function testGetSetQueued() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$this->assertSame(true, $venue->getQueued());

		$venue->setQueued(false);
		$this->assertSame(false, $venue->getQueued());
	}

	public function testGetSetEnabled() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => true));
		$this->assertSame(true, $venue->getEnabled());

		$venue->setEnabled(false);
		$this->assertSame(false, $venue->getEnabled());
	}

	public function testGetSetHidden() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => true));
		$this->assertSame(false, $venue->getHidden());

		$venue->setHidden(true);
		$this->assertSame(true, $venue->getHidden());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => true));
		$venue->delete();

		new Denkmal_Model_Venue($venue->getId());
	}
}
