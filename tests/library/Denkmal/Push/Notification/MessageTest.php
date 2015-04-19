<?php

class Denkmal_Push_Notification_MessageTest extends CMTest_TestCase {

    public function testConstruct() {
        $message = new Denkmal_Push_Notification_Message(12, ['foo' => 'bar']);
        $this->assertSame(12, $message->getTtl());
        $this->assertEquals(['foo' => 'bar'], $message->getData());
    }

    public function testOptionalFields() {
        $message = new Denkmal_Push_Notification_Message();
        $this->assertNull($message->getTtl());
        $this->assertNull($message->getData());
    }
}
