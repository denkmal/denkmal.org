<?php

class Denkmal_Http_Response_Api_AbstractTest extends CMTest_TestCase {

    protected function setUp() {
        CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
        CM_Config::get()->Denkmal_Site->urlCdn = 'http://cdn.denkmal.test';
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testSetContent() {
        $request = new CM_Http_Request_Get('/api/data', array('host' => 'denkmal.test'));
        /** @var Denkmal_Http_Response_Api_Abstract|\Mocka\AbstractClassTrait $apiResponse */
        $apiResponse = $this->mockObject('Denkmal_Http_Response_Api_Abstract', [$request, $this->getServiceManager()]);

        $content = ['foo' => 12];
        CMTest_TH::callProtectedMethod($apiResponse, '_setContent', [$content]);

        $this->assertSame($content, CM_Params::jsonDecode($apiResponse->getContent()));
        $this->assertContains('Access-Control-Allow-Origin: *', $apiResponse->getHeaders());
    }
}
