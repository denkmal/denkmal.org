<?php

class Denkmal_Model_EventLinkTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'My event', true, false, new DateTime('2017-02-01 22:00'));

        $link = Denkmal_Model_EventLink::create($event, 'foo', 'http://example.com');
        $this->assertSame('foo', $link->getLabel());
        $this->assertSame('http://example.com', $link->getUrl());

        $this->assertEquals($event, $link->getEvent());
        $this->assertSame('foo', $link->getLabel());
        $this->assertSame('http://example.com', $link->getUrl());
    }

    public function testDeleteEvent() {
        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'My event', true, false, new DateTime('2017-02-01 22:00'));
        $link = Denkmal_Model_EventLink::create($event, 'foo', 'http://example.com');

        $event->delete();
        $this->assertInstanceOf('CM_Exception_Nonexistent', $this->catchException(function() use($link) {
            new Denkmal_Model_EventLink($link->getId());
        }));
    }

}
