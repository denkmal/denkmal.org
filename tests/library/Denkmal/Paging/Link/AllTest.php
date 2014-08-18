<?php

class Denkmal_Paging_Link_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $link1 = Denkmal_Model_Link::create('foo', 'http://foo.com', true);
        $link2 = Denkmal_Model_Link::create('bar', 'http://bar.com', false);


        $paging = new Denkmal_Paging_Link_All();
        $this->assertEquals(array($link2, $link1), $paging->getItems());

        $link2->delete();
        $paging = new Denkmal_Paging_Link_All();
        $this->assertEquals(array($link1), $paging->getItems());
    }
}
