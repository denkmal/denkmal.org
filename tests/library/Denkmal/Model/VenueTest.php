<?php

class Denkmal_Model_VenueTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $this->assertSame('Example', $venue->getName());
        $this->assertSame(null, $venue->getAddress());
        $this->assertSame(null, $venue->getCoordinates());
        $this->assertSame(true, $venue->getQueued());
        $this->assertSame(false, $venue->getIgnore());
        $this->assertSame(false, $venue->getSuspended());
    }

    public function testGetSetName() {
        $venue = Denkmal_Model_Venue::create('Foo', true, false);

        $this->assertSame('Foo', $venue->getName());

        $venue->setName('Bar');
        $this->assertSame('Bar', $venue->getName());
    }

    public function testGetSetAddress() {
        $venue = Denkmal_Model_Venue::create('Example', true, false, null, 'Foo');

        $this->assertSame('Foo', $venue->getAddress());

        $venue->setAddress('Bar');
        $this->assertSame('Bar', $venue->getAddress());
    }

    public function testGetSetCoordinates() {
        $coordinates = new CM_Geo_Point(1, 2);
        $venue = Denkmal_Model_Venue::create('Example', true, false, null, null, $coordinates);
        $this->assertEquals($coordinates, $venue->getCoordinates());

        $venue->setCoordinates(null);
        $this->assertSame(null, $venue->getCoordinates());

        $coordinates2 = new CM_Geo_Point(3, 4);
        $venue->setCoordinates($coordinates2);
        $this->assertEquals($coordinates2, $venue->getCoordinates());
    }

    public function testGetSetQueued() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $this->assertSame(true, $venue->getQueued());

        $venue->setQueued(false);
        $this->assertSame(false, $venue->getQueued());
    }

    public function testGetSetIgnore() {
        $venue = Denkmal_Model_Venue::create('Example', true, true);
        $this->assertSame(true, $venue->getIgnore());

        $venue->setIgnore(false);
        $this->assertSame(false, $venue->getIgnore());
    }

    public function testGetSetSuspended() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $this->assertSame(false, $venue->getSuspended());

        $venue->setSuspended(false);
        $this->assertSame(false, $venue->getSuspended());
    }

    public function testGetSetEmail() {
        $venue = Denkmal_Model_Venue::create('Example', true, true);
        $this->assertSame(null, $venue->getEmail());

        $venue->setEmail('foo@example.com');
        $this->assertSame('foo@example.com', $venue->getEmail());

        $venue->setEmail(null);
        $this->assertSame(null, $venue->getEmail());
    }

    public function testGetSetTwitterUsername() {
        $venue = Denkmal_Model_Venue::create('Example', true, true);
        $this->assertSame(null, $venue->getTwitterUsername());

        $venue->setTwitterUsername('foo');
        $this->assertSame('foo', $venue->getTwitterUsername());

        $venue->setTwitterUsername(null);
        $this->assertSame(null, $venue->getTwitterUsername());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $venue = Denkmal_Model_Venue::create('Example', true, true);
        $venue->delete();

        new Denkmal_Model_Venue($venue->getId());
    }

    public function testFindByName() {
        $venue = Denkmal_Model_Venue::create('Foo', true, false);

        $this->assertEquals($venue, Denkmal_Model_Venue::findByName('Foo'));
        $this->assertNull(Denkmal_Model_Venue::findByName('Bar'));
    }
}
