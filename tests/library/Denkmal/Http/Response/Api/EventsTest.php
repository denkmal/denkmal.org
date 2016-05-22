<?php

class Denkmal_Http_Response_Api_EventsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Http_Request_Get('/api/events', array('host' => 'denkmal.test'));
        $response = CM_Http_Response_Abstract::factory($request, $this->getServiceManager());
        $this->assertInstanceOf('Denkmal_Http_Response_Api_Events', $response);
    }

    public function testProcess() {
        $venue1 = DenkmalTest_TH::createVenue('Venue1');
        $venue2 = DenkmalTest_TH::createVenue('Venue2');

        $now = new DateTime();
        $now->setTime(12, 0, 0);
        $event1 = Denkmal_Model_Event::create($venue1, 'Foo', true, false, $now);
        $event2 = Denkmal_Model_Event::create($venue2, 'Foo', true, false, $now);

        $request = new CM_Http_Request_Get('/api/events?venue=Venue1', array('host' => 'denkmal.test'));
        $response = new Denkmal_Http_Response_Api_Events($request, $this->getServiceManager());
        $response->process();

        $expected = array(
            'events' => array(
                $event1->toArrayApi($response->getRender()),
            )
        );

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }

    /**
     * @expectedException CM_Exception
     * @expectedExceptionMessage Cannot find venue
     */
    public function testProcessInvalidVenue() {
        $request = new CM_Http_Request_Get('/api/events?venue=VenueNonexistent', array('host' => 'denkmal.test'));
        $response = new Denkmal_Http_Response_Api_Events($request, $this->getServiceManager());
        $response->process();
    }
}
