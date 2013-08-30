<?php

class Denkmal_Model_MessageTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$text = 'foo bar';
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$message = Denkmal_Model_Message::createStatic(array(
			'text' => $text,
			'venue' => $venue
		));
		$this->assertEquals($venue, $message->getVenue());
		$this->assertSame($text, $message->getText());
		$this->assertSameTime(time(), $message->getCreated());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testOnDelete() {
		$venue = Denkmal_Model_Venue::createStatic(array('name' => 'Example', 'queued' => true, 'enabled' => false));
		$message = Denkmal_Model_Message::createStatic(array(
			'text' => 'foo',
			'venue' => $venue
		));
		$message->delete();
		new Denkmal_Model_Message($message->getId());
	}
}
