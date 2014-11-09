<?php

class Denkmal_Twitter_ClientTest extends CMTest_TestCase {

    public function testGetUrlLength() {
        $client = $this->getMockBuilder('Denkmal_Twitter_Client')
            ->disableOriginalConstructor()
            ->setMethods(['getTwitterConfiguration'])->getMock();
        $client->expects($this->any())->method('getTwitterConfiguration')->willReturn([
            'short_url_length'       => 22,
            'short_url_length_https' => 23,
        ]);
        /** @var Denkmal_Twitter_Client $client */

        $this->assertSame(22, $client->getUrlLength('http://foo.com'));
        $this->assertSame(23, $client->getUrlLength('https://foo.com'));
        $this->assertSame(22, $client->getUrlLength('http://www.example.com/foo/bar'));
        $this->assertSame(23, $client->getUrlLength('https://www.example.com/foo/bar'));
        $this->assertSame(22, $client->getUrlLength('foo.com'));
    }

    public function testGetTweetLength() {
        $client = $this->getMockBuilder('Denkmal_Twitter_Client')
            ->disableOriginalConstructor()
            ->setMethods(['getUrlLength'])->getMock();
        $client->expects($this->at(0))->method('getUrlLength')->with('example.com')->willReturn(20);
        $client->expects($this->at(1))->method('getUrlLength')->with('example.com')->willReturn(20);
        $client->expects($this->at(2))->method('getUrlLength')->with('www.example.com/mega')->willReturn(30);
        $client->expects($this->at(3))->method('getUrlLength')->with('www.example.io')->willReturn(20);
        /** @var Denkmal_Twitter_Client $client */

        $this->assertSame(strlen('test'), $client->getTweetLength('test'));
        $this->assertSame(20 + strlen('test '), $client->getTweetLength('test example.com'));
        $this->assertSame(20 + 30 + strlen('test ') + 1, $client->getTweetLength('test example.com www.example.com/mega'));
        $this->assertSame(strlen('test example.io'), $client->getTweetLength('test example.io'));
        $this->assertSame(20 + strlen('test '), $client->getTweetLength('test www.example.io'));
    }
}
