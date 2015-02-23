<?php

class Denkmal_FormField_TagsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $tag3 = Denkmal_Model_Tag::create('tag3');
        $tag3->setActive(false);

        $field = new Denkmal_FormField_Tags(['name' => 'tags']);
        $doc = $this->_renderFormField($field);

        $this->assertCount(2, $doc->find('li.tag'));
        $this->assertSame(true, $doc->has('li.tag[data-id="' . $tag1->getId() . '"]'));
        $this->assertSame(true, $doc->has('li.tag[data-id="' . $tag2->getId() . '"]'));
    }

    public function testValidate() {
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $tag3 = Denkmal_Model_Tag::create('tag3');
        $tag3->setActive(false);

        $formField = new Denkmal_FormField_Tags();
        $environment = new CM_Frontend_Environment();

        $userInput = CM_Params::jsonEncode([$tag1->getId(), $tag2->getId(), $tag3->getId()]);
        $this->assertEquals([$tag1, $tag2], $formField->validate($environment, $userInput));
    }

    /**
     * @expectedException CM_Exception_FormFieldValidation
     */
    public function testValidateWithCardinality() {
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $tag3 = Denkmal_Model_Tag::create('tag3');

        $formField = new Denkmal_FormField_Tags(['cardinality' => 2]);
        $environment = new CM_Frontend_Environment();

        $userInput = CM_Params::jsonEncode([$tag1->getId(), $tag2->getId(), $tag3->getId()]);
        $formField->validate($environment, $userInput);
    }
}
