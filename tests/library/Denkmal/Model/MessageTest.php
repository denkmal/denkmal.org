<?php

class Denkmal_Model_MessageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testCreate() {
        $text = 'foo bar';
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $created = new DateTime();
        $image = Denkmal_Model_MessageImage::create(new CM_File_Image(DIR_TEST_DATA . 'image.jpg'));
        $message = Denkmal_Model_Message::create($venue, 'client', $text, $image, $created);
        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame('client', $message->getClientId());
        $this->assertSame($text, $message->getText());
        $this->assertSameTime($created->getTimestamp(), $message->getCreated()->getTimestamp());
        $this->assertEquals($image, $message->getImage());
    }

    /**
     * @expectedException CM_Exception_Nonexistent
     */
    public function testOnDelete() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $image = Denkmal_Model_MessageImage::create(new CM_File_Image(DIR_TEST_DATA . 'image.jpg'));
        $message = Denkmal_Model_Message::create($venue, 'client', 'foo', $image);
        $message->delete();
        $this->assertFalse($image->getFile('view')->exists());
        new Denkmal_Model_Message($message->getId());
    }

    public function testGetSetHasImage() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message = Denkmal_Model_Message::create($venue, 'client', 'foo');
        $this->assertFalse($message->hasImage());
        $this->assertNull($message->getImage());

        $image = Denkmal_Model_MessageImage::create(new CM_File_Image(DIR_TEST_DATA . 'image.jpg'));
        $message->setImage($image);
        $this->assertTrue($message->hasImage());
        $this->assertEquals($image, $message->getImage());
    }

    public function testGetSetHasText() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message = Denkmal_Model_Message::create($venue, 'client');
        $this->assertFalse($message->hasText());
        $this->assertNull($message->getText());

        $message->setText('foo');
        $this->assertTrue($message->hasText());
        $this->assertSame('foo', $message->getText());
    }

    public function testGetSetClientId() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $message = Denkmal_Model_Message::create($venue, 'client');
        $this->assertSame('client', $message->getClientId());

        $message->setClientId('foo');
        $this->assertSame('foo', $message->getClientId());
    }
}
