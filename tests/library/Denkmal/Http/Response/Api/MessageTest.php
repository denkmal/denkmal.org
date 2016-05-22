<?php

class Denkmal_Http_Response_Api_MessageTest extends CMTest_TestCase {

    /** @var string */
    private $_hashToken;

    /** @var string */
    private $_hashAlgorithm;

    protected function setUp() {
        $this->_hashToken = 'abcdef';
        $this->_hashAlgorithm = 'sha1';

        CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
        CM_Config::get()->Denkmal_Site->urlCdn = 'http://cdn.denkmal.test';
        CM_Config::get()->Denkmal_Http_Response_Api_Message->hashToken = $this->_hashToken;
        CM_Config::get()->Denkmal_Http_Response_Api_Message->hashAlgorithm = $this->_hashAlgorithm;
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Http_Request_Post('/api/message', array('host' => 'denkmal.test'));
        $response = CM_Http_Response_Abstract::factory($request, $this->getServiceManager());
        $this->assertInstanceOf('Denkmal_Http_Response_Api_Message', $response);
    }

    public function testProcess() {
        $venue = DenkmalTest_TH::createVenue();
        $text = 'hallo test';
        $body = http_build_query(array(
            'venue'    => $venue->getId(),
            'clientId' => 'client',
            'text'     => $text,
            'hash'     => hash($this->_hashAlgorithm, $this->_hashToken . $text),
        ));
        $request = new CM_Http_Request_Post('/api/message', array('host' => 'denkmal.test'), array('remote_addr' => '1.2.3.4'), $body);
        $response = new Denkmal_Http_Response_Api_Message($request, $this->getServiceManager());
        $dateTime = new DateTime();
        $createTime = $dateTime->getTimestamp();
        $response->process();

        $messageList = new Denkmal_Paging_Message_All();
        $this->assertCount(1, $messageList);
        /** @var Denkmal_Model_Message $message */
        $message = $messageList->getItem(0);
        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame('client', $message->getClientId());
        $this->assertSame('hallo test', $message->getText());
        $this->assertSame(null, $message->getImage());
        $this->assertSameTime($createTime, $message->getCreated()->getTimestamp());
    }

    public function testProcessImage() {
        $venue = DenkmalTest_TH::createVenue();
        $file = $file = new CM_File(DIR_TEST_DATA . 'image.jpg');
        $body = http_build_query(array(
            'venue'      => $venue->getId(),
            'clientId'   => 'client',
            'image-data' => base64_encode($file->read()),
            'hash'       => hash($this->_hashAlgorithm, $this->_hashToken . md5($file->read())),
        ));
        $request = new CM_Http_Request_Post('/api/message', array('host' => 'denkmal.test'), array('remote_addr' => '1.2.3.4'), $body);
        $response = new Denkmal_Http_Response_Api_Message($request, $this->getServiceManager());
        $dateTime = new DateTime();
        $createTime = $dateTime->getTimestamp();
        $response->process();

        $messageList = new Denkmal_Paging_Message_All();
        $this->assertCount(1, $messageList);
        /** @var Denkmal_Model_Message $message */
        $message = $messageList->getItem(0);
        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame('client', $message->getClientId());
        $this->assertSame(null, $message->getText());
        $this->assertSameTime($createTime, $message->getCreated()->getTimestamp());
        $imageFileThumb = new CM_Image_Image($message->getImage()->getFile('thumb')->read());
        $this->assertSame(CM_Image_Image::FORMAT_JPEG, $imageFileThumb->getFormat());
        $imageFileView = new CM_Image_Image($message->getImage()->getFile('view')->read());
        $this->assertSame(CM_Image_Image::FORMAT_JPEG, $imageFileView->getFormat());
    }

    /**
     * @expectedException CM_Exception_Invalid
     * @expectedExceptionMessage Either `text` or `image-data` is required.
     */
    public function testProcessMissingTextOrImage() {
        $venue = DenkmalTest_TH::createVenue();
        $body = http_build_query(array(
            'venue'    => $venue->getId(),
            'clientId' => 'client',
            'hash'     => 'foo',
        ));
        $request = new CM_Http_Request_Post('/api/message', array('host' => 'denkmal.test'), array('remote_addr' => '1.2.3.4'), $body);
        $response = new Denkmal_Http_Response_Api_Message($request, $this->getServiceManager());
        $response->process();
    }

    /**
     * @expectedException CM_Exception_Invalid
     * @expectedExceptionMessage Specifying both `text` and `image-data` is not allowed.
     */
    public function testProcessBothTextAndImage() {
        $venue = DenkmalTest_TH::createVenue();
        $body = http_build_query(array(
            'venue'      => $venue->getId(),
            'clientId'   => 'client',
            'text'       => 'foo',
            'image-data' => 'bar',
            'hash'       => 'foo bar',
        ));
        $request = new CM_Http_Request_Post('/api/message', array('host' => 'denkmal.test'), array('remote_addr' => '1.2.3.4'), $body);
        $response = new Denkmal_Http_Response_Api_Message($request, $this->getServiceManager());
        $response->process();
    }
}
