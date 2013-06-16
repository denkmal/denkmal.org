<?php

class Denkmal_Paging_Message_AllTest extends CMTest_TestCase {

	public function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testGetItems() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Example', 'queued' => false, 'enabled' => true));

		$message1 = Denkmal_Model_Message::create(array('venue' => $venue, 'text' => 'Foo 1'));
		CMTest_TH::timeForward(1);
		$message2 = Denkmal_Model_Message::create(array('venue' => $venue, 'text' => 'Foo 2'));
		CMTest_TH::timeForward(1);
		$paging = new Denkmal_Paging_Message_All();
		$this->assertEquals(array($message1, $message2), $paging->getItems());

		$message3 = Denkmal_Model_Message::create(array('venue' => $venue, 'text' => 'Foo 3'));
		CMTest_TH::timeForward(1);
		$paging = new Denkmal_Paging_Message_All();
		$this->assertEquals(array($message1, $message2, $message3), $paging->getItems());

		$message3->delete();
		$paging = new Denkmal_Paging_Message_All();
		$this->assertEquals(array($message1, $message2), $paging->getItems());
	}
}
