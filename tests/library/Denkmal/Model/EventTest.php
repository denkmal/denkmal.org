<?php

class Denkmal_Model_EventTest extends CMTest_TestCase {

	/** @var Denkmal_Model_Event */
	private $_event;

	protected function setUp() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$this->_event = Denkmal_Model_Event::create($venue, 'Foo', true, false, new DateTime());
	}

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$this->assertInstanceOf('Denkmal_Model_Venue', $this->_event->getVenue());
		$this->assertInstanceOf('DateTime', $this->_event->getFrom());
		$this->assertSame(null, $this->_event->getUntil());
		$this->assertSame('Foo', $this->_event->getDescription());
		$this->assertSame(null, $this->_event->getTitle());
		$this->assertSame(null, $this->_event->getSong());
		$this->assertSame(false, $this->_event->getQueued());
		$this->assertSame(true, $this->_event->getEnabled());
		$this->assertSame(false, $this->_event->getHidden());
		$this->assertSame(false, $this->_event->getStarred());
	}

	public function testGetSetVenue() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example2', 'queued' => true, 'enabled' => false));
		$this->assertNotEquals($venue, $this->_event->getVenue());
		$this->_event->setVenue($venue);
		$this->assertEquals($venue, $this->_event->getVenue());
	}

	public function testGetSetFrom() {
		$later = new DateTime();
		$later->add(new DateInterval('P1D'));
		$this->_event->setFrom($later);
		$this->assertEquals($later, $this->_event->getFrom());
	}

	public function testGetSetUntil() {
		$now = new DateTime();

		$this->_event->setUntil(null);
		$this->assertEquals(null, $this->_event->getUntil());

		$this->_event->setUntil($now);
		$this->assertEquals($now, $this->_event->getUntil());
	}

	public function testGetSetDescription() {
		$this->_event->setDescription('Bar');
		$this->assertSame('Bar', $this->_event->getDescription());
	}

	public function testGetSetTitle() {
		$this->_event->setTitle(null);
		$this->assertSame(null, $this->_event->getTitle());

		$this->_event->setTitle('Bar');
		$this->assertSame('Bar', $this->_event->getTitle());
	}

	public function testGetSetSong() {
		$song = Denkmal_Model_Song::create('Foo', CM_File::createTmp());
		$this->_event->setSong($song);
		$this->assertEquals($song, $this->_event->getSong());

		$this->_event->setSong(null);
		$this->assertSame(null, $this->_event->getSong());
	}

	public function testGetSetQueued() {
		$this->_event->setQueued(true);
		$this->assertSame(true, $this->_event->getQueued());
	}

	public function testGetSetEnabled() {
		$this->_event->setEnabled(false);
		$this->assertSame(false, $this->_event->getEnabled());
	}

	public function testGetSetHidden() {
		$this->_event->setHidden(true);
		$this->assertSame(true, $this->_event->getHidden());
	}

	public function testGetSetStarred() {
		$this->_event->setStarred(true);
		$this->assertSame(true, $this->_event->getStarred());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$this->_event->delete();

		new Denkmal_Model_Event($this->_event->getId());
	}
}
