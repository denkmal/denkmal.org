<?php

class Denkmal_Http_Response_Api_AbstractTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testSetContent() {
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = new CM_Http_Request_Get('/api/data');
        /** @var Denkmal_Http_Response_Api_Abstract|\Mocka\AbstractClassTrait $apiResponse */
        $apiResponse = $this->mockObject('Denkmal_Http_Response_Api_Abstract', [$request, $site, $this->getServiceManager()]);

        $content = ['foo' => 12];
        CMTest_TH::callProtectedMethod($apiResponse, '_setContent', [$content]);

        $this->assertSame($content, CM_Params::jsonDecode($apiResponse->getContent()));
        $this->assertContains('Content-Type: application/json', $apiResponse->getHeaders());
        $this->assertContains('Access-Control-Allow-Origin: *', $apiResponse->getHeaders());
    }
}
