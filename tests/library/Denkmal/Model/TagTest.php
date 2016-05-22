<?php

class Denkmal_Model_TagTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $tag = Denkmal_Model_Tag::create('foo');
        $this->assertInstanceOf('Denkmal_Model_Tag', $tag);
        $this->assertSame('foo', $tag->getLabel());
        $this->assertSame(true, $tag->getActive());
    }

    /**
     * @expectedException CM_Db_Exception
     */
    public function testCreateDuplicate() {
        Denkmal_Model_Tag::create('foo');
        Denkmal_Model_Tag::create('foo');
    }

    public function testGetSetLabel() {
        $tag = Denkmal_Model_Tag::create('foo');
        $tag->setLabel('bar');
        $this->assertSame('bar', $tag->getLabel());
        $tag->setLabel('foo');
        $this->assertSame('foo', $tag->getLabel());
    }

    public function testGetSetActive() {
        $tag = Denkmal_Model_Tag::create('foo');
        $tag->setActive(false);
        $this->assertSame(false, $tag->getActive());
        $tag->setActive(true);
        $this->assertSame(true, $tag->getActive());
    }

    /**
     * @expectedException CM_Exception_Invalid
     */
    public function testDelete() {
        $tag = Denkmal_Model_Tag::create('foo');
        $tag->delete();
    }

    public function testFindByLabel() {
        $tagFoo = Denkmal_Model_Tag::create('foo');
        $tagBar = Denkmal_Model_Tag::create('bar');

        $this->assertEquals($tagFoo, Denkmal_Model_Tag::findByLabel('foo'));
        $this->assertNull(Denkmal_Model_Tag::findByLabel('something'));
    }
}
