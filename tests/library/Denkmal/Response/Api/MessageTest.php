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
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));

		$body = 'venue=' . urlencode($venue->getId()) . '&text=' . urlencode('hallo test');
		$request = new CM_Request_Post('/api/message', array('host' => 'denkmal.test'), $body);
		$response = new Denkmal_Response_Api_Message($request);
		$response->process();

		$messageList = new Denkmal_Paging_Message_All();
		$this->assertCount(1, $messageList);
		/** @var Denkmal_Model_Message $message */
		$message = $messageList->getItem(0);
		$this->assertEquals($venue, $message->getVenue());
		$this->assertSame('hallo test', $message->getText());
		$this->assertSameTime(time(), $message->getCreated()->getTimestamp());
	}
}
