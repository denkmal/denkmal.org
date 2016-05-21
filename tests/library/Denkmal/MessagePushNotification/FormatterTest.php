<?php

class Denkmal_MessagePushNotification_FormatterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGuest() {
        $site = $this->getMockSite('Denkmal_Site_Default', null, ['url' => 'https://www.denkmal.org']);
        $environment = new CM_Frontend_Environment($site);
        $render = new CM_Frontend_Render($environment);
        $formatter = new Denkmal_MessagePushNotification_Formatter($render);

        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $tag1 = Denkmal_Model_Tag::create('foo');
        $tag2 = Denkmal_Model_Tag::create('bar');
        $imageFile = new CM_File(DIR_TEST_DATA . 'image.jpg');
        $image = Denkmal_Model_MessageImage::create(new CM_Image_Image($imageFile->read()));
        $message = Denkmal_Model_Message::create($venue, 'client', null, 'Hello World', $image);
        $message->getTags()->add($tag1);
        $message->getTags()->add($tag2);

        $this->assertSame('Example', $formatter->getTitle($message));
        $this->assertSame('Hello World #foo #bar #image', $formatter->getBody($message));
        $this->assertSame('https://www.denkmal.org/now', $formatter->getUrl());
    }

    public function testUser() {
        $render = new CM_Frontend_Render();
        $formatter = new Denkmal_MessagePushNotification_Formatter($render);

        $user = Denkmal_Model_User::create('foo@example.com', 'mark', 'passwd');
        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $message = Denkmal_Model_Message::create($venue, 'client', $user, 'Hello World');

        $this->assertSame('Example', $formatter->getTitle($message));
        $this->assertSame('mark: Hello World', $formatter->getBody($message));
    }
}
