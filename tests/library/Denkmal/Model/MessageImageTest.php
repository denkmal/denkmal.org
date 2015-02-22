<?php

class Denkmal_Model_MessageImageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $file = new CM_File_Image(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);

        $this->assertInstanceOf('Denkmal_Model_MessageImage', $messageImage);
        $this->assertTrue($messageImage->getFile('view')->exists());
        $this->assertTrue($messageImage->getFile('thumb')->exists());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $file = new CM_File_Image(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);
        $messageImage->delete();
        $this->assertFalse($messageImage->getFile('view')->exists());
        $this->assertFalse($messageImage->getFile('thumb')->exists());
        new Denkmal_Model_Song($messageImage->getId());
    }
}
