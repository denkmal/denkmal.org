<?php

class Denkmal_Http_Response_Api_EventsTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Http_Request_Get('/api/events', array('host' => 'denkmal.test'));
        $responseFactory = new CM_Http_ResponseFactory($this->getServiceManager());
        $response = $responseFactory->getResponse($request);
        $this->assertInstanceOf('Denkmal_Http_Response_Api_Events', $response);
    }

    public function testProcess() {
        $region = Denkmal_Model_Region::findBySlug('basel');
        $venue1 = DenkmalTest_TH::createVenue('Venue1', null, null, $region);
        $venue2 = DenkmalTest_TH::createVenue('Venue2', null, null, $region);

        $now = new DateTime();
        $now->setTime(12, 0, 0);
        $event1 = Denkmal_Model_Event::create($venue1, 'My event 1', true, false, $now);
        $event2 = Denkmal_Model_Event::create($venue2, 'My event 2', true, false, $now);

        $site = new Denkmal_Site_Region_Basel();
        $request = new CM_Http_Request_Get('/api/events?venue=Venue1');
        $response = Denkmal_Http_Response_Api_Events::createFromRequest($request, $site, $this->getServiceManager());
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
        $site = new Denkmal_Site_Region_Basel();
        $request = new CM_Http_Request_Get('/api/events?venue=VenueNonexistent');
        $response = Denkmal_Http_Response_Api_Events::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();
    }
}
