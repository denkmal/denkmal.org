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
}
