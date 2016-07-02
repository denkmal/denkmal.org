<?php

class Denkmal_Model_VenueTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $region = DenkmalTest_TH::createRegion();
        $venue = Denkmal_Model_Venue::create('Example', true, false, $region);

        $this->assertSame('Example', $venue->getName());
        $this->assertSame(null, $venue->getAddress());
        $this->assertSame(null, $venue->getCoordinates());
        $this->assertSame(true, $venue->getQueued());
        $this->assertSame(false, $venue->getIgnore());
        $this->assertSame(false, $venue->getSuspended());
        $this->assertSame(false, $venue->getSecret());
        $this->assertEquals($region, $venue->getRegion());
    }

    public function testGetSetName() {
        $venue = Denkmal_Model_Venue::create('Foo', true, false, DenkmalTest_TH::createRegion());

        $this->assertSame('Foo', $venue->getName());

        $venue->setName('Bar');
        $this->assertSame('Bar', $venue->getName());
    }

    public function testGetSetAddress() {
        $venue = Denkmal_Model_Venue::create('Example', true, false, DenkmalTest_TH::createRegion(), null, 'Foo');

        $this->assertSame('Foo', $venue->getAddress());

        $venue->setAddress('Bar');
        $this->assertSame('Bar', $venue->getAddress());
    }

    public function testGetSetCoordinates() {
        $coordinates = new CM_Geo_Point(1, 2);
        $venue = Denkmal_Model_Venue::create('Example', true, false, DenkmalTest_TH::createRegion(), null, null, $coordinates);
        $this->assertEquals($coordinates, $venue->getCoordinates());

        $venue->setCoordinates(null);
        $this->assertSame(null, $venue->getCoordinates());

        $coordinates2 = new CM_Geo_Point(3, 4);
        $venue->setCoordinates($coordinates2);
        $this->assertEquals($coordinates2, $venue->getCoordinates());
    }

    public function testGetSetQueued() {
        $venue = Denkmal_Model_Venue::create('Example', true, false, DenkmalTest_TH::createRegion());
        $this->assertSame(true, $venue->getQueued());

        $venue->setQueued(false);
        $this->assertSame(false, $venue->getQueued());
    }

    public function testGetSetIgnore() {
        $venue = Denkmal_Model_Venue::create('Example', true, true, DenkmalTest_TH::createRegion());
        $this->assertSame(true, $venue->getIgnore());

        $venue->setIgnore(false);
        $this->assertSame(false, $venue->getIgnore());
    }

    public function testGetSetSuspended() {
        $venue = Denkmal_Model_Venue::create('Example', true, false, DenkmalTest_TH::createRegion());
        $this->assertSame(false, $venue->getSuspended());

        $venue->setSuspended(false);
        $this->assertSame(false, $venue->getSuspended());
    }

    public function testGetSetSecret() {
        $venue = Denkmal_Model_Venue::create('Example', true, false, DenkmalTest_TH::createRegion());
        $this->assertSame(false, $venue->getSecret());

        $venue->setSecret(false);
        $this->assertSame(false, $venue->getSecret());
    }

    public function testGetSetEmail() {
        $venue = Denkmal_Model_Venue::create('Example', true, true, DenkmalTest_TH::createRegion());
        $this->assertSame(null, $venue->getEmail());

        $venue->setEmail('foo@example.com');
        $this->assertSame('foo@example.com', $venue->getEmail());

        $venue->setEmail(null);
        $this->assertSame(null, $venue->getEmail());
    }

    public function testGetSetTwitterUsername() {
        $venue = Denkmal_Model_Venue::create('Example', true, true, DenkmalTest_TH::createRegion());
        $this->assertSame(null, $venue->getTwitterUsername());

        $venue->setTwitterUsername('foo');
        $this->assertSame('foo', $venue->getTwitterUsername());

        $venue->setTwitterUsername(null);
        $this->assertSame(null, $venue->getTwitterUsername());
    }

    public function testGetSetRegion() {
        $regionNY = DenkmalTest_TH::createRegion();
        $venue = Denkmal_Model_Venue::create('Example', true, true, $regionNY);
        $this->assertEquals($regionNY, $venue->getRegion());

        $regionNY2 = DenkmalTest_TH::createRegion('West Coast', 'westc', 'WCT');
        $venue->setRegion($regionNY2);
        $this->assertEquals($regionNY2, $venue->getRegion());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $venue = Denkmal_Model_Venue::create('Example', true, true, DenkmalTest_TH::createRegion());
        $venue->delete();

        new Denkmal_Model_Venue($venue->getId());
    }

    public function testFindByName() {
        $region1 = DenkmalTest_TH::createRegion();
        $region2 = DenkmalTest_TH::createRegion();
        $venue = Denkmal_Model_Venue::create('Foo', true, false, $region1);

        $this->assertEquals($venue, Denkmal_Model_Venue::findByName($region1, 'Foo'));
        $this->assertNull(Denkmal_Model_Venue::findByName($region2, 'Foo'));
        $this->assertNull(Denkmal_Model_Venue::findByName($region1, 'Bar'));
    }
}
