<?php

class Denkmal_Paging_EventLink_EventTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'My event', true, false, new DateTime('2017-02-01 22:00'));
        $link1 = Denkmal_Model_EventLink::create($event, 'my link 1', 'http://example.com/link-1');
        $link2 = Denkmal_Model_EventLink::create($event, 'my link 2', 'http://example.com/link-2');

        $this->assertEquals([$link1, $link2], new Denkmal_Paging_EventLink_Event($event));

        $link2->delete();
        $this->assertEquals([$link1], new Denkmal_Paging_EventLink_Event($event));
    }
}
