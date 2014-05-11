<?php

class Denkmal_Response_Api_DataTest extends CMTest_TestCase {

    protected function setUp() {
        CM_Config::get()->Denkmal_Site->url = 'http://denkmal.test';
        CM_Config::get()->Denkmal_Site->urlCdn = 'http://cdn.denkmal.test';
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testMatch() {
        $request = new CM_Request_Get('/api/data', array('host' => 'denkmal.test'));
        $response = CM_Response_Abstract::factory($request);
        $this->assertInstanceOf('Denkmal_Response_Api_Data', $response);
    }

    public function testProcess() {
        $coordinates1 = new CM_Geo_Point(12.1, 13.3);
        $venue1 = Denkmal_Model_Venue::create('Foo 1', true, false, 'http://www.example.com', 'Address 1', $coordinates1);
        $venue2 = Denkmal_Model_Venue::create('Foo 2', true, false);

        $now = new DateTime();
        $now->setTime(12, 0, 0);
        $file1 = CM_File::createTmp();
        $song1 = Denkmal_Model_Song::create('Song 1', $file1);
        $event1 = Denkmal_Model_Event::create($venue2, 'Foo', true, false, $now, $now, $song1);
        $event2 = Denkmal_Model_Event::create($venue2, 'Foo', true, false, $now);

        $message1 = Denkmal_Model_Message::create($venue1, 'Foo 1');
        $message2 = Denkmal_Model_Message::create($venue1, 'Foo 2');

        $request = new CM_Request_Get('/api/data', array('host' => 'denkmal.test'));
        $response = new Denkmal_Response_Api_Data($request);
        $response->process();

        $expected = array(
            'venues'         => array(
                $venue1->toArrayApi($response->getRender()),
                $venue2->toArrayApi($response->getRender()),
            ),
            'events'         => array(
                $event1->toArrayApi($response->getRender()),
                $event2->toArrayApi($response->getRender()),
            ),
            'messages'       => array(
                $message1->toArrayApi($response->getRender()),
                $message2->toArrayApi($response->getRender()),
            ),
            'dayOffset'      => Denkmal_Site::getDayOffset(),
            'suspendedUntil' => null,
        );

        $this->assertSame($expected, json_decode($response->getContent(), true));
    }
}
