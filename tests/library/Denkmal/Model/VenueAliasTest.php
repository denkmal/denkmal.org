<?php

class Denkmal_Model_VenueAliasTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $venue = DenkmalTest_TH::createVenue();
        $venueAlias = Denkmal_Model_VenueAlias::create($venue, 'Foo');

        $this->assertSame('Foo', $venueAlias->getName());
        $this->assertEquals($venue, $venueAlias->getVenue());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $venue = DenkmalTest_TH::createVenue();
        $venueAlias = Denkmal_Model_VenueAlias::create($venue, 'Foo');
        $venueAlias->delete();

        new Denkmal_Model_VenueAlias($venueAlias->getId());
    }

    public function testFindByName() {
        $region1 = DenkmalTest_TH::createRegion();
        $region2 = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue(null, null, null, $region1);
        $venueAlias = Denkmal_Model_VenueAlias::create($venue, 'Foo');

        $this->assertEquals($venueAlias, Denkmal_Model_VenueAlias::findByName($region1, 'Foo'));
        $this->assertNull(Denkmal_Model_VenueAlias::findByName($region2, 'Foo'));
        $this->assertNull(Denkmal_Model_VenueAlias::findByName($region1, 'Bar'));
    }
}
