<?php

class Denkmal_Paging_Message_RegionTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $region = DenkmalTest_TH::createRegion('regio 1', 'regio-1', 'r1');
        $venue = DenkmalTest_TH::createVenue(null, null, null, $region);
        $regionOther = DenkmalTest_TH::createRegion('regio 2', 'regio-2', 'r2');
        $venueOther = DenkmalTest_TH::createVenue(null, null, null, $regionOther);

        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 1', null, new DateTime('2010-01-01'));
        $message2 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 2', null, new DateTime('2010-01-02'));
        $messageOther = Denkmal_Model_Message::create($venueOther, 'client', null, 'Foo Other', null, new DateTime('2010-01-02'));
        $paging = new Denkmal_Paging_Message_Region($region);

        $this->assertEquals(array($message2, $message1), $paging->getItems());

        $message3 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 3');
        $paging = new Denkmal_Paging_Message_Region($region);
        $this->assertEquals(array($message3, $message2, $message1), $paging->getItems());

        $message3->delete();
        $paging = new Denkmal_Paging_Message_Region($region);
        $this->assertEquals(array($message2, $message1), $paging->getItems());
    }
}
