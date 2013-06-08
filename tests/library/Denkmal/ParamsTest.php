<?php

class Denkmal_Model_ParamsTest extends CMTest_TestCase {

	public function testGetVenue() {
		$venue = Denkmal_Model_Venue::create(array('name' => 'Foo', 'enabled' => true, 'queued' => false));

		$params = new Denkmal_Params(array('venue1' => $venue, 'venue2' => $venue->getId()));

		$this->assertEquals($venue, $params->getVenue('venue1'));
		$this->assertEquals($venue, $params->getVenue('venue2'));
	}
}
