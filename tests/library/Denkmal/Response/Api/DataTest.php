<?php

class Denkmal_Response_Api_DataTest extends CMTest_TestCase {

	protected function setUp() {
		CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
	}

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testMatch() {
		$request = new CM_Request_Get('/api/data', array('host' => 'denkmal.test'));
		$response = CM_Response_Abstract::factory($request);
		$this->assertInstanceOf('Denkmal_Response_Api_Data', $response);
	}

	public function testProcess() {
		$coordinates1 = new CM_Geo_Point(12.1, 13.3);
		$venue1 = Denkmal_Model_Venue::create(array('name'    => 'Foo 1', 'queued' => true, 'enabled' => false, 'url' => 'http://www.example.com',
													'address' => 'Address 1', 'coordinates' => $coordinates1));
		$venue2 = Denkmal_Model_Venue::create(array('name' => 'Foo 2', 'queued' => true, 'enabled' => false));

		$now = new DateTime();
		$file1 = CM_File::createTmp();
		$song1 = Denkmal_Model_Song::create(array('file' => $file1, 'label' => 'Song 1'));
		$event1 = Denkmal_Model_Event::create(array('venue'   => $venue2, 'from' => $now, 'until' => $now, 'description' => 'Foo', 'queued' => false,
													'enabled' => true, 'song' => $song1));
		$event2 = Denkmal_Model_Event::create(array('venue'   => $venue1, 'from' => $now, 'description' => 'Foo', 'queued' => false,
													'enabled' => true));

		$message1 = Denkmal_Model_Message::create(array('venue' => $venue1, 'text' => 'Foo 1'));
		$message2 = Denkmal_Model_Message::create(array('venue' => $venue1, 'text' => 'Foo 2'));

		$request = new CM_Request_Get('/api/data', array('host' => 'denkmal.test'));
		$response = new Denkmal_Response_Api_Data($request);
		$response->process();

		$expected = array(
			'venues'   => array(
				$venue1->toArrayApi(),
				$venue2->toArrayApi(),
			),
			'events'   => array(
				$event1->toArrayApi($response->getRender()),
				$event2->toArrayApi($response->getRender()),
			),
			'messages' => array(
				$message1->toArrayApi(),
				$message2->toArrayApi(),
			),
		);

		$this->assertSame($expected, json_decode($response->getContent(), true));
	}
}
