<?php

class Denkmal_Paging_Tag_Venue_HipsterTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetTags() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 1', null, new DateTime());

        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');

        $message1->getTags()->add($tag1);
        $message1->getTags()->add($tag2);

        $tagList = new Denkmal_Paging_Tag_Venue_Hipster($venue);
        $this->assertEquals(array($tag1, $tag2), $tagList);
    }

    public function testAggregation() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 1', null, (new DateTime())->sub(new DateInterval('PT3S')));
        $message2 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 2', null, (new DateTime())->sub(new DateInterval('PT2S')));
        $message3 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 3', null, (new DateTime())->sub(new DateInterval('PT1S')));

        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');
        $tag3 = Denkmal_Model_Tag::create('foobar');
        $tag4 = Denkmal_Model_Tag::create('barfoo');

        $message1->getTags()->add($tag1);

        $message2->getTags()->add($tag2);
        $message2->getTags()->add($tag3);

        $message3->getTags()->add($tag4);

        $tagList = new Denkmal_Paging_Tag_Venue_Hipster($venue);
        $this->assertEquals(array($tag4, $tag2, $tag3, $tag1), $tagList);
    }

    public function testTimeLimit() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 1', null, (new DateTime())->sub(new DateInterval('PT2H')));
        $message2 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 2', null, (new DateTime())->sub(new DateInterval('PT30M')));
        $message3 = Denkmal_Model_Message::create($venue, 'client', null, 'Message 3', null, new DateTime());

        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');
        $tag3 = Denkmal_Model_Tag::create('zoo');

        $message1->getTags()->add($tag1);
        $message2->getTags()->add($tag2);
        $message3->getTags()->add($tag3);

        $tagList = new Denkmal_Paging_Tag_Venue_Hipster($venue);
        $this->assertEquals(array($tag3, $tag2), $tagList);

        $timeMin = (new DateTime())->sub(new DateInterval('PT10M'));
        $tagList = new Denkmal_Paging_Tag_Venue_Hipster($venue, $timeMin->getTimestamp());
        $this->assertEquals(array($tag3), $tagList);
    }
}
