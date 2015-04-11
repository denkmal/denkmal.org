<?php

class Denkmal_Paging_Tag_ModelTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $model1 = Denkmal_Model_Link::create('foo', 'http://www.example.com', true);
        $model2 = Denkmal_Model_Link::create('bar', 'http://www.example.com', true);
        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');

        $tagList1 = new Denkmal_Paging_Tag_Model($model1);
        $tagList2 = new Denkmal_Paging_Tag_Model($model2);

        $tagList1->add($tag1);
        $this->assertEquals([$tag1], $tagList1);
        $this->assertEquals([], $tagList2);

        $tagList1->add($tag2);
        $this->assertEquals([$tag1, $tag2], $tagList1);
        $this->assertEquals([], $tagList2);

        $tagList1->delete($tag1);
        $this->assertEquals([$tag2], $tagList1);
        $this->assertEquals([], $tagList2);
    }

    public function testAddSameTagTwice() {
        $model = Denkmal_Model_Link::create('foo', 'http://www.example.com', true);
        $tag = Denkmal_Model_Tag::create('foo');

        $tagList = new Denkmal_Paging_Tag_Model($model);

        $tagList->add($tag);
        $tagList->add($tag);
        $this->assertEquals([$tag, $tag], $tagList);
    }

    public function testDeleteAll(){
        $model = Denkmal_Model_Link::create('foo', 'http://www.example.com', true);
        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');

        $tagList = new Denkmal_Paging_Tag_Model($model);

        $tagList->add($tag1);
        $tagList->add($tag2);
        $this->assertEquals([$tag1, $tag2], $tagList);

        $tagList->deleteAll();
        $this->assertEquals([], $tagList);
    }
}
