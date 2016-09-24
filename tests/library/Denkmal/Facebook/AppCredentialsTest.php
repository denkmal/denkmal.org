<?php

class Denkmal_Facebook_AppCredentialsTest extends CMTest_TestCase {

    public function testConstructor() {
        $credentials = new Denkmal_Facebook_AppCredentials('my-id', 'my-secret');

        $this->assertSame('my-id', $credentials->getId());
        $this->assertSame('my-secret', $credentials->getSecret());
    }


    public function testComparable() {
        $credentials1 = new Denkmal_Facebook_AppCredentials('id1', 'secret1');
        $credentials1b = new Denkmal_Facebook_AppCredentials('id1', 'secret1');
        $credentials2 = new Denkmal_Facebook_AppCredentials('id2', 'secret2');

        $this->assertSame(true, $credentials1->equals($credentials1b));
        $this->assertSame(false, $credentials1->equals($credentials2));
    }

    public function testArrayConvertible() {
        $credentials = new Denkmal_Facebook_AppCredentials('my-id', 'my-secret');

        $this->assertEquals($credentials, Denkmal_Facebook_AppCredentials::fromArray($credentials->toArray()));
    }

}
