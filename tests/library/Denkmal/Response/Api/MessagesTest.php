<?php

class Denkmal_Response_Api_MessagesTest extends CMTest_TestCase {

	protected function setUp() {
		CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
	}

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testMatch() {
		$request = new CM_Request_Get('/api/messages', array('host' => 'denkmal.test'));
		$response = CM_Response_Abstract::factory($request);
		$this->assertInstanceOf('Denkmal_Response_Api_Messages', $response);
	}

	public function testProcess() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$message1 = Denkmal_Model_Message::create(array('venue' => $venue, 'text' => 'Foo 1'));
		$message2 = Denkmal_Model_Message::create(array('venue' => $venue, 'text' => 'Foo 2'));

		$request = new CM_Request_Get('/api/messages', array('host' => 'denkmal.test'));
		$response = new Denkmal_Response_Api_Messages($request);
		$response->process();

		$expected = array(
			array(
				'_type'   => $message1->getType(),
				'_id'     => array('id' => $message1->getId()),
				'id'      => $message1->getId(),
				'venue'   => $message1->getVenue()->getId(),
				'created' => $message1->getCreated(),
				'text'    => $message1->getText(),
			),
			array(
				'_type'   => $message2->getType(),
				'_id'     => array('id' => $message2->getId()),
				'id'      => $message2->getId(),
				'venue'   => $message2->getVenue()->getId(),
				'created' => $message2->getCreated(),
				'text'    => $message2->getText(),
			),
		);

		$this->assertSame($expected, json_decode($response->getContent(), true));
	}
}
