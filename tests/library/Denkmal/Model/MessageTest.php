<?php

class Denkmal_Model_MessageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $text = 'foo bar';
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $created = new DateTime();
        $image = Denkmal_Model_MessageImage::create(new CM_File(DIR_TEST_DATA . 'image.jpg'));
        $message = Denkmal_Model_Message::create($venue, $text, $image, $created);
        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame($text, $message->getText());
        $this->assertSameTime($created->getTimestamp(), $message->getCreated()->getTimestamp());
        $this->assertEquals($image, $message->getImage());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testOnDelete() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $image = Denkmal_Model_MessageImage::create(new CM_File(DIR_TEST_DATA . 'image.jpg'));
        $message = Denkmal_Model_Message::create($venue, 'foo', $image);
        $message->delete();
        $this->assertFalse($image->getFile()->getExists());
        new Denkmal_Model_Message($message->getId());
    }

    public function getSetHasImage() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message = Denkmal_Model_Message::create($venue, 'foo');
        $this->assertFalse($message->hasImage());
        $this->assertNull($message->getImage());

        $image = Denkmal_Model_MessageImage::create(new CM_File(DIR_TEST_DATA . 'image.jpg'));
        $message->setImage($image);
        $this->assertTrue($message->hasImage());
        $this->assertEquals($image, $message->getImage());
    }

    public function getSetHasText() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message = Denkmal_Model_Message::create($venue);
        $this->assertFalse($message->hasText());
        $this->assertNull($message->getText());

        $message->setText('foo');
        $this->assertTrue($message->hasText());
        $this->assertSame('foo', $message->getText());
    }
}
