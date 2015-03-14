<?php

class Denkmal_Paging_Tag_VenueUserLatestTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetTags() {
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $tag3 = Denkmal_Model_Tag::create('tag3');
        $tag4 = Denkmal_Model_Tag::create('tag4');

        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 1', null, new DateTime('@1'));
        $message1->getTags()->add($tag1);
        $message1->getTags()->add($tag2);

        $this->assertEquals(array($tag1, $tag2), new Denkmal_Paging_Tag_VenueUserLatest($venue, new DateTime('@0')));

        $message2 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 2', null, new DateTime('@2'));
        $message2->getTags()->add($tag3);

        $messageWithoutUser = Denkmal_Model_Message::create($venue, 'client', null, 'Message 3', null, new DateTime('@3'));
        $messageWithoutUser->getTags()->add($tag1);

        $message4 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 4', null, new DateTime('@4'));
        $message4->getTags()->add($tag4);

        $this->assertEquals(array($tag1, $tag2), new Denkmal_Paging_Tag_VenueUserLatest($venue, new DateTime('@0')));

        CMTest_TH::clearCache();
        $this->assertEquals(array($tag4, $tag3, $tag1, $tag2, $tag1), new Denkmal_Paging_Tag_VenueUserLatest($venue, new DateTime('@0')));
    }

    public function testTimeLimit() {
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        $venue = Denkmal_Model_Venue::create('Example', true, false);

        $message1 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 1', null, (new DateTime())->sub(new DateInterval('PT2H')));
        $message2 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 2', null, (new DateTime())->sub(new DateInterval('PT30M')));
        $message3 = Denkmal_Model_Message::create($venue, 'client', $user, 'Message 3', null, new DateTime());

        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');
        $tag3 = Denkmal_Model_Tag::create('zoo');

        $message1->getTags()->add($tag1);
        $message2->getTags()->add($tag2);
        $message3->getTags()->add($tag3);

        $tagList = new Denkmal_Paging_Tag_VenueUserLatest($venue);
        $this->assertEquals(array($tag3, $tag2), $tagList);

        $timeMin = (new DateTime())->sub(new DateInterval('PT10M'));
        $tagList = new Denkmal_Paging_Tag_VenueUserLatest($venue, $timeMin);
        $this->assertEquals(array($tag3), $tagList);
    }
}
