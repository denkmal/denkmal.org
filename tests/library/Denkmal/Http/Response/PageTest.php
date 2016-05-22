<?php

class Denkmal_Http_Response_PageTest extends CMTest_TestCase {

    protected function setUp() {
        $location = CMTest_TH::createLocation();
        $region = Denkmal_Model_Region::create('Graz', 'graz', 'GRZ', $location);
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $this->getMockSite('Denkmal_Site_Region_Graz', null, ['host' => 'denkmal.test']);

        $request = new CM_Http_Request_Get('/graz/events', ['host' => 'denkmal.test']);
        $response = CM_Http_Response_Abstract::factory($request, $this->getServiceManager());
        $this->assertInstanceOf('Denkmal_Http_Response_Page', $response);
    }

}
