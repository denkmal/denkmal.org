<?php

class Denkmal_Response_Api_MessageTest extends CMTest_TestCase {

	protected function setUp() {
		CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
	}

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testMatch() {
		$request = new CM_Request_Post('/api/message', array('host' => 'denkmal.test'));
		$response = CM_Response_Abstract::factory($request);
		$this->assertInstanceOf('Denkmal_Response_Api_Message', $response);
	}

	public function testProcess() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));

		$body = 'venue=' . urlencode($venue->getId()) . '&text=' . urlencode('hallo test');
		$request = new CM_Request_Post('/api/message', array('host' => 'denkmal.test'), $body);
		$response = new Denkmal_Response_Api_Message($request);
		$response->process();
	}
}
