<?php

class Denkmal_Model_SongTest extends CMTest_TestCase {

	public function testCreate() {
		$label = 'foo';
		$file = CM_File::createTmp();
		$song = Denkmal_Model_Song::create($label, $file);

		$this->assertInstanceOf('Denkmal_Model_Song', $song);
		$this->assertSame($label, $song->getLabel());
		$this->assertTrue($song->getFile()->getExists());
	}

	public function testSetLabel() {
		$song = Denkmal_Model_Song::create('foo', CM_File::createTmp());
		$this->assertSame('foo', $song->getLabel());
		$song->setLabel('bar');
		$this->assertSame('bar', $song->getLabel());
	}

	/**
	 * @expectedException CM_Exception_Nonexistent
	 */
	public function testDelete() {
		$song = Denkmal_Model_Song::create('foo', CM_File::createTmp());
		$song->delete();
		$this->assertFalse($song->getFile()->getExists());
		new Denkmal_Model_Song($song->getId());
	}
}
