<?php

class Denkmal_Response_Api_MessageTest extends CMTest_TestCase {

	/** @var string */
	private $_hashToken;

	/** @var string */
	private $_hashAlgorithm;

	protected function setUp() {
		$this->_hashToken = 'abcdef';
		$this->_hashAlgorithm = 'sha1';

		CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
		CM_Config::get()->Denkmal_Response_Api_Message->hashToken = $this->_hashToken;
		CM_Config::get()->Denkmal_Response_Api_Message->hashAlgorithm = $this->_hashAlgorithm;
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
		$venue = Denkmal_Model_Venue::create('Example', true, false);
		$venueId = $venue->getId();
		$text = 'hallo test';

		$body = 'venue=' . urlencode($venueId)
				. '&text=' . urlencode($text)
				. '&hash=' . hash($this->_hashAlgorithm, $this->_hashToken . $text);
		$request = new CM_Request_Post('/api/message', array('host' => 'denkmal.test'), $body);
		$response = new Denkmal_Response_Api_Message($request);
		$dateTime = new DateTime();
		$createTime = $dateTime->getTimestamp();
		$response->process();

		$messageList = new Denkmal_Paging_Message_All();
		$this->assertCount(1, $messageList);
		/** @var Denkmal_Model_Message $message */
		$message = $messageList->getItem(0);
		$this->assertEquals($venue, $message->getVenue());
		$this->assertSame('hallo test', $message->getText());
		$this->assertSameTime($createTime, $message->getCreated()->getTimestamp());
	}
}
