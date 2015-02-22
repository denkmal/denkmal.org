<?php

class Denkmal_Paging_Tag_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');

        $this->assertEquals(array($tag2, $tag1), new Denkmal_Paging_Tag_All());

        $tag3 = Denkmal_Model_Tag::create('aaa');
        $this->assertEquals(array($tag3, $tag2, $tag1), new Denkmal_Paging_Tag_All());
    }
}
