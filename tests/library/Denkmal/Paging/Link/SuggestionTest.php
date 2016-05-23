<?php

class Denkmal_Paging_Link_SuggestionTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $link1 = Denkmal_Model_Link::create('foo', 'http://foo.com', true);
        $link2 = Denkmal_Model_Link::create('bar', 'http://bar.com', false);
        $link3 = Denkmal_Model_Link::create('my zoo', 'http://my-zoo.com', false);

        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'my event foo my zoo mega', true, false, new DateTime());

        $paging = new Denkmal_Paging_Link_Suggestion($event);
        $this->assertEquals(array($link3), $paging->getItems());

        $event->setDescription('my event foo [my zoo] bar mega');
        $paging = new Denkmal_Paging_Link_Suggestion($event);
        $this->assertEquals(array($link2), $paging->getItems());
    }
}
