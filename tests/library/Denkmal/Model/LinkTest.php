<?php

class Denkmal_Model_LinkTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$link = Denkmal_Model_Link::create(array(
			'label'     => 'foo',
			'url'       => 'bar',
			'automatic' => true,
		));
		$this->assertSame('foo', $link->getLabel());
		$this->assertSame('bar', $link->getUrl());
		$this->assertSame(true, $link->getAutomatic());
	}
}
