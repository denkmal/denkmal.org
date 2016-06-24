<?php

class Denkmal_Http_Response_Api_MessagesTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Http_Request_Get('/api/messages', array('host' => 'denkmal.test'));
        $responseFactory = new CM_Http_ResponseFactory($this->getServiceManager());
        $response = $responseFactory->getResponse($request);
        $this->assertInstanceOf('Denkmal_Http_Response_Api_Messages', $response);
    }

    public function testProcess() {
        $created = new DateTime();
        $venue = DenkmalTest_TH::createVenue('Example');
        $maxMessages = 5;

        $messageList = array();
        $imageFile = new CM_File(DIR_TEST_DATA . 'image.jpg');
        for ($i = 0; $i < $maxMessages + 3; $i++) {
            $image = null;
            if (0 == $i) {
                $image = Denkmal_Model_MessageImage::create(new CM_Image_Image($imageFile->read()));
            }
            $messageList[] = Denkmal_Model_Message::create($venue, 'client', null, 'Foo ' . $i, $image, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $query = http_build_query(array('maxMessages' => $maxMessages));
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = new CM_Http_Request_Get('/api/messages?' . $query);
        $response = Denkmal_Http_Response_Api_Messages::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $expected = Functional\map(array_slice($messageList, 3), function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }

    public function testProcessMinimumMessagesPerVenue() {
        $created = new DateTime();
        $maxMessages = 5;
        $minMessagesVenue = 4;
        $settings = new Denkmal_App_Settings();

        $venueNoEvents = DenkmalTest_TH::createVenue('Example 1');
        $messageListNoEvent = array();
        for ($i = 0; $i < $minMessagesVenue + 6; $i++) {
            $messageListNoEvent[] = Denkmal_Model_Message::create($venueNoEvents, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $venueHasEvents = DenkmalTest_TH::createVenue('Example 2');
        $eventDate = $settings->getCurrentDate()->add(new DateInterval('P2D'));
        Denkmal_Model_Event::create($venueHasEvents, 'Foo', true, false, $eventDate);
        $messageListHasEvent = array();
        for ($i = 0; $i < $minMessagesVenue + 7; $i++) {
            $messageListHasEvent[] = Denkmal_Model_Message::create($venueHasEvents, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $venue = DenkmalTest_TH::createVenue('Example 3');
        $messageList = array();
        for ($i = 0; $i < $maxMessages + 8; $i++) {
            $messageList[] = Denkmal_Model_Message::create($venue, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $query = http_build_query(array('maxMessages' => $maxMessages, 'minMessagesVenue' => $minMessagesVenue));
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = new CM_Http_Request_Get('/api/messages?' . $query);
        $response = Denkmal_Http_Response_Api_Messages::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $expectedMessageList = array_merge(array_slice($messageListHasEvent, 7), array_slice($messageList, 8));
        $expected = Functional\map($expectedMessageList, function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }

    public function testProcessStartAfterId() {
        $created = new DateTime();
        $venue = DenkmalTest_TH::createVenue('Example');

        /** @var Denkmal_Model_Message[] $messageList */
        $messageList = array();
        for ($i = 0; $i < 10; $i++) {
            $messageList[] = Denkmal_Model_Message::create($venue, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $query = http_build_query(array('startAfterId' => $messageList[7]->getId()));
        $site = $this->getMockSite('Denkmal_Site_Default', null, ['url' => 'http://denkmal.test']);
        $request = new CM_Http_Request_Get('/api/messages?' . $query);
        $response = Denkmal_Http_Response_Api_Messages::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $expected = Functional\map(array_slice($messageList, 8), function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }
}
