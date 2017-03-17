<?php

class Denkmal_EventTweeter_EventTweeterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetEventText() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue('Example');
        $event = Denkmal_Model_Event::create($venue, 'Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));
        $eventId = $event->getId();

        $this->assertSame("Denkmal recommends: Example (22:00) Lorem ipsum dolor sit amet denkmal.org/events?event=${eventId}",
            $eventTweeter->getEventText($event, 140));
    }

    public function testGetEventTextWithUntil() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue('Example');
        $event = Denkmal_Model_Event::create($venue, 'Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'), new DateTime('2014-11-02 2:00'));
        $eventId = $event->getId();

        $this->assertSame("Denkmal recommends: Example (22:00-2:00) Lorem ipsum dolor sit amet denkmal.org/events?event=${eventId}",
            $eventTweeter->getEventText($event, 140));
    }

    public function testGetEventTextCutOff() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue('Example');
        $event = Denkmal_Model_Event::create($venue, 'Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));
        $eventId = $event->getId();

        $this->assertSame("Denkmal recommends: Example (22:00) Lorem ipsum… denkmal.org/events?event=${eventId}",
            $eventTweeter->getEventText($event, 70));
    }

    public function testGetEventTextWithUrl() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue('Example');
        $event = Denkmal_Model_Event::create($venue, 'example.com Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));
        $eventId = $event->getId();

        $this->assertSame("Denkmal recommends: Example (22:00) example.com Lorem ipsum… denkmal.org/events?event=${eventId}",
            $eventTweeter->getEventText($event, 95));
    }

    /**
     * @expectedException CM_Exception_Invalid
     * @expectedExceptionMessage Suffix length exceeds max-length
     */
    public function testGetEventTextSuffixTooLong() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue('Example');
        $event = Denkmal_Model_Event::create($venue, 'example.com Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));

        $eventTweeter->getEventText($event, 10);
    }

    public function testGetEventTextWithTwitterUsername() {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = DenkmalTest_TH::createVenue();
        $venue->setTwitterUsername('ExampleTwitter');
        $event = Denkmal_Model_Event::create($venue, 'Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));
        $eventId = $event->getId();

        $this->assertSame(
            "Denkmal recommends: @ExampleTwitter (22:00) Lorem ipsum dolor sit amet denkmal.org/events?event=${eventId}",
            $eventTweeter->getEventText($event, 140)
        );
    }

    /**
     * @param string              $expected
     * @param int                 $maxLength
     * @param Denkmal_Model_Event $event
     */
    private function _assertGetEventText($expected, $maxLength, Denkmal_Model_Event $event) {
        $eventTweeter = new Denkmal_EventTweeter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $this->assertSame($expected, $eventTweeter->getEventText($event, $maxLength));
    }

    /**
     * @return Denkmal_Twitter_Client|\Mocka\AbstractClassTrait
     */
    private function _getTwitterClientMock() {
        $client = $this->mockClass('Denkmal_Twitter_Client')->newInstanceWithoutConstructor();
        $client->mockMethod('getUrlLength')->set(function () {
            return 20;
        });
        /** @var Denkmal_Twitter_Client $client */
        return $client;
    }

    /**
     * @return CM_Frontend_Render
     */
    private function _getRender() {
        $site = $this->getMockSite('Denkmal_Site_Default', null, [
            'url' => 'http://www.denkmal.org',
        ]);
        $environment = new CM_Frontend_Environment($site);
        return new CM_Frontend_Render($environment);
    }
}
