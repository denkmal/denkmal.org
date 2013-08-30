<?php

class Denkmal_Model_EventTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$now = new DateTime();
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => $now, 'description' => 'Foo', 'queued' => false, 'enabled' => true));

		$this->assertEquals($venue, $event->getVenue());
		$this->assertEquals($now, $event->getFrom());
		$this->assertSame(null, $event->getUntil());
		$this->assertSame('Foo', $event->getDescription());
		$this->assertSame(null, $event->getTitle());
		$this->assertSame(null, $event->getSong());
		$this->assertSame(false, $event->getQueued());
		$this->assertSame(true, $event->getEnabled());
		$this->assertSame(false, $event->getHidden());
		$this->assertSame(false, $event->getStarred());
	}

	public function testGetSetVenue() {
		$now = new DateTime();
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => $now, 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertEquals($venue, $event->getVenue());

		$venue2 = Denkmal_Model_Venue::createStatic(array('name' => 'Example2', 'queued' => true, 'enabled' => false));
		$event->setVenue($venue2);
		$this->assertEquals($venue2, $event->getVenue());
	}

	public function testGetSetFrom() {
		$now = new DateTime();
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => $now, 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertEquals($now, $event->getFrom());

		$later = clone $now;
		$later->add(new DateInterval('P1D'));
		$event->setFrom($later);
		$this->assertEquals($later, $event->getFrom());
	}

	public function testGetSetUntil() {
		$now = new DateTime();
		$later = clone $now;
		$later->add(new DateInterval('P1D'));
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => $now, 'description' => 'Foo', 'queued' => false, 'enabled' => true, 'until' => $later));
		$this->assertEquals($later, $event->getUntil());

		$event->setUntil(null);
		$this->assertEquals(null, $event->getUntil());

		$event->setUntil($now);
		$this->assertEquals($now, $event->getUntil());
	}

	public function testGetSetDescription() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertSame('Foo', $event->getDescription());

		$event->setDescription('Bar');
		$this->assertSame('Bar', $event->getDescription());
	}

	public function testGetSetTitle() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true, 'title' => 'Foo'));
		$this->assertSame('Foo', $event->getTitle());

		$event->setTitle(null);
		$this->assertSame(null, $event->getTitle());

		$event->setTitle('Bar');
		$this->assertSame('Bar', $event->getTitle());
	}

	public function testGetSetSong() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertSame(null, $event->getSong());

		$song = Denkmal_Model_Song::createStatic(array('file' => CM_File::createTmp(), 'label' => 'Foo'));
		$event->setSong($song);
		$this->assertEquals($song, $event->getSong());

		$event->setSong(null);
		$this->assertSame(null, $event->getSong());
	}

	public function testGetSetQueued() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => true, 'enabled' => true));
		$this->assertSame(true, $event->getQueued());

		$event->setQueued(false);
		$this->assertSame(false, $event->getQueued());
	}

	public function testGetSetEnabled() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertSame(true, $event->getEnabled());

		$event->setEnabled(false);
		$this->assertSame(false, $event->getEnabled());
	}

	public function testGetSetHidden() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertSame(false, $event->getHidden());

		$event->setHidden(true);
		$this->assertSame(true, $event->getHidden());
	}

	public function testGetSetStarred() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$this->assertSame(false, $event->getStarred());

		$event->setStarred(true);
		$this->assertSame(true, $event->getStarred());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$event = Denkmal_Model_Event::createStatic(array('venue' => $venue, 'from' => new DateTime(), 'description' => 'Foo', 'queued' => false, 'enabled' => true));
		$event->delete();

		new Denkmal_Model_Event($event->getId());
	}
}
