<?php

class Denkmal_Paging_Message_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 1', null, new DateTime('2010-01-01'));
        $message2 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 2', null, new DateTime('2010-01-02'));
        $paging = new Denkmal_Paging_Message_All();

        $this->assertEquals(array($message2, $message1), $paging->getItems());

        $message3 = Denkmal_Model_Message::create($venue, 'client', null, 'Foo 3');
        $paging = new Denkmal_Paging_Message_All();
        $this->assertEquals(array($message3, $message2, $message1), $paging->getItems());

        $message3->delete();
        $paging = new Denkmal_Paging_Message_All();
        $this->assertEquals(array($message2, $message1), $paging->getItems());
    }
}
