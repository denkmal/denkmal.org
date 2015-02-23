<?php

class Denkmal_Paging_Tag_Venue_HipsterTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 1', null, new DateTime('2010-01-01'));
        $message2 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 2', null, new DateTime('2010-01-02'));
        $message3 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 3', null, new DateTime('2010-01-03'));

        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');
        $tag3 = Denkmal_Model_Tag::create('foobar');

        $message1->getTags()->add($tag1);
        $message1->getTags()->add($tag2);
        $message1->getTags()->add($tag3);

        $message2->getTags()->add($tag2);

        $message3->getTags()->add($tag1);
        $message3->getTags()->add($tag3);

        $tagList = new Denkmal_Paging_Tag_Venue_Hipster($venue);
        $this->assertEquals(array($tag1, $tag3, $tag2, $tag1, $tag2, $tag3), $tagList);
    }
}
