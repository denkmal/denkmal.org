<?php

class Denkmal_Model_EventCategoryTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $category = Denkmal_Model_EventCategory::create('cat-1', new CM_Color_RGB(120, 0, 0), ['foo']);
        $this->assertSame('cat-1', $category->getLabel());
        $this->assertEquals(new CM_Color_RGB(120, 0, 0), $category->getColor());
        $this->assertSame(['foo'], $category->getGenreList());
    }

    public function testGetSetGenreList() {
        $category = Denkmal_Model_EventCategory::create('cat-1', new CM_Color_RGB(255, 0, 0), ['foo']);
        $this->assertSame(['foo'], $category->getGenreList());

        $category->setGenreList(['foo', 'bar']);
        $this->assertSame(['foo', 'bar'], $category->getGenreList());
    }

}
