<?php

class Denkmal_ModelAsset_TagsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetAll() {
        $model = Denkmal_Model_Link::create('foo', 'http://www.example.com', true);
        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');

        $asset = new Denkmal_ModelAsset_Tags($model);
        $asset->add($tag1);
        $asset->add($tag2);
        $this->assertEquals([$tag1, $tag2], $asset->getAll());

        $asset->delete($tag1);
        $this->assertEquals([$tag2], $asset->getAll());
    }

    public function testOnModelDelete() {
        $model = Denkmal_Model_Link::create('foo', 'http://www.example.com', true);
        $tag1 = Denkmal_Model_Tag::create('foo');

        $asset = new Denkmal_ModelAsset_Tags($model);
        $asset->add($tag1);

        $asset->_onModelDelete();
        $this->assertEquals([], $asset->getAll());
    }
}
