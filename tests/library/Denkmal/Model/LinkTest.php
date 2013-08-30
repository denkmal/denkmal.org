<?php

class Denkmal_Model_LinkTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testCreate() {
		$link = Denkmal_Model_Link::createStatic(array(
			'label'     => 'foo',
			'url'       => 'bar',
			'automatic' => true,
		));
		$this->assertSame('foo', $link->getLabel());
		$this->assertSame('bar', $link->getUrl());
		$this->assertSame(true, $link->getAutomatic());
	}

	public function testCreateDefaultValues() {
		$link = Denkmal_Model_Link::createStatic(array(
			'label'     => 'foo',
			'url'       => 'bar',
		));
		$this->assertSame(false, $link->getAutomatic());
	}

	public function testSetAutomatic() {
		$link = Denkmal_Model_Link::createStatic(array(
			'label'     => 'foo',
			'url'       => 'bar',
			'automatic' => true,
		));
		$this->assertSame(true, $link->getAutomatic());
		$link->setAutomatic(false);
		$this->assertSame(false, $link->getAutomatic());
	}
}
