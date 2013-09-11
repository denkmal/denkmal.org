<?php

class Denkmal_Model_VenueTest extends CMTest_TestCase {

	/** @var CM_Geo_Point $_coordinates */
	private $_coordinates = null;

	protected function setUp() {
		$this->_coordinates = new CM_Geo_Point(null, null);
	}

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$venue = Denkmal_Model_Venue::create('Example', null, null, $this->_coordinates, true, false, false);

		$this->assertSame('Example', $venue->getName());
		$this->assertSame(null, $venue->getAddress());
		$this->assertEquals($this->_coordinates, $venue->getCoordinates());
		$this->assertSame(true, $venue->getQueued());
		$this->assertSame(false, $venue->getEnabled());
		$this->assertSame(false, $venue->getHidden());
	}

	public function testGetSetName() {
		$venue = Denkmal_Model_Venue::create('Foo', null, null, $this->_coordinates, true, false, false);

		$this->assertSame('Foo', $venue->getName());

		$venue->setName('Bar');
		$this->assertSame('Bar', $venue->getName());
	}

	public function testGetSetAddress() {
		$venue = Denkmal_Model_Venue::create('Example', null, 'Foo', $this->_coordinates, true, false, false);

		$this->assertSame('Foo', $venue->getAddress());

		$venue->setAddress('Bar');
		$this->assertSame('Bar', $venue->getAddress());
	}

	public function testGetSetCoordinates() {
		$coordinates = new CM_Geo_Point(1, 2);
		$venue = Denkmal_Model_Venue::create('Example', 'Foo', null, $coordinates, true, false, false);
		$this->assertEquals($coordinates, $venue->getCoordinates());

		$venue->setCoordinates(null);
		$this->assertSame(null, $venue->getCoordinates());

		$coordinates2 = new CM_Geo_Point(3, 4);
		$venue->setCoordinates($coordinates2);
		$this->assertEquals($coordinates2, $venue->getCoordinates());
	}

	public function testGetSetQueued() {
		$venue = Denkmal_Model_Venue::create('Example', 'Foo', null, $this->_coordinates, true, false, false);
		$this->assertSame(true, $venue->getQueued());

		$venue->setQueued(false);
		$this->assertSame(false, $venue->getQueued());
	}

	public function testGetSetEnabled() {
		$venue = Denkmal_Model_Venue::create('Example', 'Foo', null, $this->_coordinates, true, true, false);
		$this->assertSame(true, $venue->getEnabled());

		$venue->setEnabled(false);
		$this->assertSame(false, $venue->getEnabled());
	}

	public function testGetSetHidden() {
		$venue = Denkmal_Model_Venue::create('Example', 'Foo', null, $this->_coordinates, true, true, false);
		$this->assertSame(false, $venue->getHidden());

		$venue->setHidden(true);
		$this->assertSame(true, $venue->getHidden());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$venue = Denkmal_Model_Venue::create('Example', null, null, $this->_coordinates, true, true, false);
		$venue->delete();

		new Denkmal_Model_Venue($venue->getId());
	}

	public function testFindByName() {
		$venue = Denkmal_Model_Venue::create('Foo', null, null, $this->_coordinates, true, false, false);

		$this->assertEquals($venue, Denkmal_Model_Venue::findByName('Foo'));
		$this->assertNull(Denkmal_Model_Venue::findByName('Bar'));
	}
}
