<?php

class Denkmal_Twitter_EventTweeterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testTweetStarredEvents() {
        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, new DateTime('2014-11-01 11:00'), null, null, null, true);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 2', true, false, new DateTime('2014-11-01 12:00'), null, null, null, false);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 3', true, false, new DateTime('2014-11-01 13:00'), null, null, null, true);
        $event4 = Denkmal_Model_Event::create($venue, 'Foo 4', true, false, new DateTime('2014-11-01 14:00'), null, null, null, true);
        $event5 = Denkmal_Model_Event::create($venue, 'Foo 5', true, false, new DateTime('2014-11-01 15:00'), null, null, null, true);
        $event6 = Denkmal_Model_Event::create($venue, 'Foo 5', true, false, new DateTime('2014-11-02 20:00'), null, null, null, true);

        $client = $this->_getTwitterClientMock();
        $eventTweeter = new Denkmal_Twitter_EventTweeter($client, $this->_getRender());
        $client->mockMethod('createTweet')->at(0, function ($text) use ($eventTweeter, $event1) {
            $this->assertSame($eventTweeter->getEventText($event1, 140), $text);
        });
        $client->mockMethod('createTweet')->at(1, function ($text) use ($eventTweeter, $event3) {
            $this->assertSame($eventTweeter->getEventText($event3, 140), $text);
        });
        $client->mockMethod('createTweet')->at(2, function ($text) use ($eventTweeter, $event4) {
            $this->assertSame($eventTweeter->getEventText($event4, 140), $text);
        });
        /** @var Denkmal_Twitter_Client $client */

        $eventTweeter->tweetStarredEvents(new DateTime('2014-11-01'));
    }

    public function testGetEventText() {
        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00) Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            140
        );
    }

    public function testGetEventTextWithUntil() {
        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00-2:00) Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), new DateTime('2014-11-02 2:00'),
            140
        );
    }

    public function testGetEventTextCutOff() {
        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00) Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            70
        );
    }

    public function testGetEventTextWithUrl() {
        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00) example.com Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'example.com Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            95
        );
    }

    public function testGetEventTextWithLink() {
        Denkmal_Model_Link::create('Lorem', 'http://www.lorem.com', true);

        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00) Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            70
        );
    }

    /**
     * @expectedException CM_Exception_Invalid
     * @expectedExceptionMessage Suffix length exceeds max-length
     */
    public function testGetEventTextSuffixTooLong() {
        $this->_assertGetEventText(
            'Denkmal recommends: Example (22:00) Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            10
        );
    }

    public function testGetEventTextWithTwitterUsername() {
        $eventTweeter = new Denkmal_Twitter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $venue->setTwitterUsername('ExampleTwitter');
        $event = Denkmal_Model_Event::create($venue, 'Lorem ipsum dolor sit amet', true, false, new DateTime('2014-11-01 22:00'));
        $this->assertSame(
            'Denkmal recommends: @ExampleTwitter (22:00) Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            $eventTweeter->getEventText($event, 140)
        );
    }

    /**
     * @param string        $expected
     * @param string        $description
     * @param DateTime      $from
     * @param DateTime|null $until
     * @param int           $maxLength
     */
    private function _assertGetEventText($expected, $description, DateTime $from, DateTime $until = null, $maxLength) {
        $eventTweeter = new Denkmal_Twitter_EventTweeter($this->_getTwitterClientMock(), $this->_getRender());
        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $event = Denkmal_Model_Event::create($venue, $description, true, false, $from, $until);
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
