<?php

class Denkmal_Model_MessageImageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $file = new CM_File(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);

        $this->assertInstanceOf('Denkmal_Model_MessageImage', $messageImage);
        $this->assertTrue($messageImage->getFile()->getExists());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testDelete() {
        $file = new CM_File(DIR_TEST_DATA . 'image.jpg');
        $messageImage = Denkmal_Model_MessageImage::create($file);
        $messageImage->delete();
        $this->assertFalse($messageImage->getFile()->getExists());
        new Denkmal_Model_Song($messageImage->getId());
    }
}
