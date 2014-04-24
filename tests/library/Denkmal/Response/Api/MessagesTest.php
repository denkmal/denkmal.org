<?php

class Denkmal_Response_Api_MessagesTest extends CMTest_TestCase {

    protected function setUp() {
        CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
        CM_Config::get()->Denkmal_Site->urlCdn = 'http://cdn.denkmal.test';
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Request_Get('/api/messages', array('host' => 'denkmal.test'));
        $response = CM_Response_Abstract::factory($request);
        $this->assertInstanceOf('Denkmal_Response_Api_Messages', $response);
    }

    public function testProcess() {
        $venue = Denkmal_Model_Venue::create('Example', true, false);
        $maxMessages = 5;

        $messageList = array();
        for ($i = 0; $i < $maxMessages + 3; $i++) {
            $messageList[] = Denkmal_Model_Message::create($venue, 'Foo ' . $i);
        }

        $query = http_build_query(array('maxMessages' => $maxMessages));
        $request = new CM_Request_Get('/api/messages?' . $query, array('host' => 'denkmal.test'));
        $response = new Denkmal_Response_Api_Messages($request);
        $response->process();

        $expected = Functional\map(array_slice($messageList, 3), function (Denkmal_Model_Message $message) use ($response) {
            return $message->toArrayApi($response->getRender());
        });

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }
}
