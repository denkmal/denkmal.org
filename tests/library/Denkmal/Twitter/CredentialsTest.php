<?php

class Denkmal_Twitter_CredentialsTest extends CMTest_TestCase {

    public function testConstructor() {
        $credentials = new Denkmal_Twitter_Credentials('my-consumerKey', 'my-consumerSecret', 'my-accessToken', 'my-accessTokenSecret');

        $this->assertSame('my-consumerKey', $credentials->getConsumerKey());
        $this->assertSame('my-consumerSecret', $credentials->getConsumerSecret());
        $this->assertSame('my-accessToken', $credentials->getAccessToken());
        $this->assertSame('my-accessTokenSecret', $credentials->getAccessTokenSecret());
    }

    public function testConstructorOptionals() {
        $credentials = new Denkmal_Twitter_Credentials('my-consumerKey', 'my-consumerSecret');

        $this->assertSame('my-consumerKey', $credentials->getConsumerKey());
        $this->assertSame('my-consumerSecret', $credentials->getConsumerSecret());
        $this->assertSame(null, $credentials->getAccessToken());
        $this->assertSame(null, $credentials->getAccessTokenSecret());
    }

    public function testComparable() {
        $credentials1 = new Denkmal_Twitter_Credentials('consumerKey1', 'consumerSecret1', 'accessToken1', 'accessTokenSecret1');
        $credentials1b = new Denkmal_Twitter_Credentials('consumerKey1', 'consumerSecret1', 'accessToken1', 'accessTokenSecret1');
        $credentials2 = new Denkmal_Twitter_Credentials('consumerKey2', 'consumerSecret2', 'accessToken2', 'accessTokenSecret2');

        $this->assertSame(true, $credentials1->equals($credentials1b));
        $this->assertSame(false, $credentials1->equals($credentials2));
    }

    public function testArrayConvertible() {
        $credentials = new Denkmal_Twitter_Credentials('my-consumerKey', 'my-consumerSecret', 'my-accessToken', 'my-accessTokenSecret');

        $this->assertEquals($credentials, Denkmal_Twitter_Credentials::fromArray($credentials->toArray()));
    }

}
