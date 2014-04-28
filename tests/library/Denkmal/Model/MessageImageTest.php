<?php

class Denkmal_Model_MessageImageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $file = new CM_File_Image(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);

        $this->assertInstanceOf('Denkmal_Model_MessageImage', $messageImage);
        $this->assertTrue($messageImage->getFile('view')->getExists());
        $this->assertTrue($messageImage->getFile('thumb')->getExists());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $file = new CM_File_Image(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);
        $messageImage->delete();
        $this->assertFalse($messageImage->getFile('view')->getExists());
        $this->assertFalse($messageImage->getFile('thumb')->getExists());
        new Denkmal_Model_Song($messageImage->getId());
    }
}
