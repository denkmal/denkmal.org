<?php

class Denkmal_Paging_EventCategory_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $category1 = Denkmal_Model_EventCategory::create('cat-1', new CM_Color_RGB(255, 0, 0), []);
        $category2 = Denkmal_Model_EventCategory::create('cat-2', new CM_Color_RGB(0, 255, 0), []);

        $this->assertEquals([$category1, $category2], new Denkmal_Paging_EventCategory_All());

        $category1->delete();
        $this->assertEquals([$category2], new Denkmal_Paging_EventCategory_All());
    }
}
