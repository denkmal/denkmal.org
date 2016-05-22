<?php

class Denkmal_Http_Response_Api_MessagesTest extends CMTest_TestCase {

    protected function setUp() {
        CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
        CM_Config::get()->Denkmal_Site->urlCdn = 'http://cdn.denkmal.test';
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Http_Request_Get('/api/messages', array('host' => 'denkmal.test'));
        $response = CM_Http_Response_Abstract::factory($request, $this->getServiceManager());
        $this->assertInstanceOf('Denkmal_Http_Response_Api_Messages', $response);
    }

    public function testProcess() {
        $created = new DateTime();
        $venue = DenkmalTest_TH::createVenue();
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
        $request = new CM_Http_Request_Get('/api/messages?' . $query, array('host' => 'denkmal.test'));
        $response = new Denkmal_Http_Response_Api_Messages($request, $this->getServiceManager());
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

        $venueNoEvents = DenkmalTest_TH::createVenue();
        $messageListNoEvent = array();
        for ($i = 0; $i < $minMessagesVenue + 6; $i++) {
            $messageListNoEvent[] = Denkmal_Model_Message::create($venueNoEvents, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $venueHasEvents = DenkmalTest_TH::createVenue();
        $eventDate = Denkmal_Site::getCurrentDate()->add(new DateInterval('P2D'));
        Denkmal_Model_Event::create($venueHasEvents, 'Foo', true, false, $eventDate);
        $messageListHasEvent = array();
        for ($i = 0; $i < $minMessagesVenue + 7; $i++) {
            $messageListHasEvent[] = Denkmal_Model_Message::create($venueHasEvents, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $venue = DenkmalTest_TH::createVenue();
        $messageList = array();
        for ($i = 0; $i < $maxMessages + 8; $i++) {
            $messageList[] = Denkmal_Model_Message::create($venue, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $query = http_build_query(array('maxMessages' => $maxMessages, 'minMessagesVenue' => $minMessagesVenue));
        $request = new CM_Http_Request_Get('/api/messages?' . $query, array('host' => 'denkmal.test'));
        $response = new Denkmal_Http_Response_Api_Messages($request, $this->getServiceManager());
        $response->process();

        $expectedMessageList = array_merge(array_slice($messageListHasEvent, 7), array_slice($messageList, 8));
        $expected = Functional\map($expectedMessageList, function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }

    public function testProcessStartAfterId() {
        $created = new DateTime();
        $venue = DenkmalTest_TH::createVenue();

        /** @var Denkmal_Model_Message[] $messageList */
        $messageList = array();
        for ($i = 0; $i < 10; $i++) {
            $messageList[] = Denkmal_Model_Message::create($venue, 'client', null, 'Foo ' . $i, null, $created);
            $created->add(new DateInterval('PT3S'));
        }

        $query = http_build_query(array('startAfterId' => $messageList[7]->getId()));
        $request = new CM_Http_Request_Get('/api/messages?' . $query, array('host' => 'denkmal.test'));
        $response = new Denkmal_Http_Response_Api_Messages($request, $this->getServiceManager());
        $response->process();

        $expected = Functional\map(array_slice($messageList, 8), function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }
}
