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

        $client = $this->getMockBuilder('Denkmal_Twitter_Client')->disableOriginalConstructor()
            ->setMethods(['getUrlLength', 'createTweet'])->getMock();
        $client->expects($this->any())->method('getUrlLength')->willReturn(20);

        $render = new CM_Frontend_Render();
        $eventTweeter = new Denkmal_Twitter_EventTweeter($client, $render);
        $client->expects($this->at(0))->method('createTweet')->with($eventTweeter->getEventText($event1, 140));
        $client->expects($this->at(1))->method('createTweet')->with($eventTweeter->getEventText($event3, 140));
        $client->expects($this->at(2))->method('createTweet')->with($eventTweeter->getEventText($event4, 140));
        /** @var Denkmal_Twitter_Client $client */

        $eventTweeter->tweetStarredEvents(new DateTime('2014-11-01'));
    }

    public function testGetEventText() {
        $this->_assertGetEventText(
            '22:00 Example: Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            140
        );
    }

    public function testGetEventTextWithUntil() {
        $this->_assertGetEventText(
            '22:00-2:00 Example: Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), new DateTime('2014-11-02 2:00'),
            140
        );
    }

    public function testGetEventTextCutOff() {
        $this->_assertGetEventText(
            '22:00 Example: Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            50
        );
    }

    public function testGetEventTextWithUrl() {
        $this->_assertGetEventText(
            '22:00 Example: example.com Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'example.com Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            70
        );
    }

    public function testGetEventTextWithLink() {
        Denkmal_Model_Link::create('Lorem', 'http://www.lorem.com', true);

        $this->_assertGetEventText(
            '22:00 Example: Lorem ipsum… denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            50
        );
    }

    /**
     * @expectedException CM_Exception_Invalid
     * @expectedExceptionMessage Suffix length exceeds max-length
     */
    public function testGetEventTextSuffixTooLong() {
        $this->_assertGetEventText(
            '22:00 Example: Lorem ipsum dolor sit amet denkmal.org/events?date=2014-11-1',
            'Lorem ipsum dolor sit amet',
            new DateTime('2014-11-01 22:00'), null,
            10
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
        $site = $this->getMockSite('Denkmal_Site', null, [
            'url' => 'http://www.denkmal.org',
        ]);
        $environment = new CM_Frontend_Environment($site);
        $render = new CM_Frontend_Render($environment);

        $client = $this->getMockBuilder('Denkmal_Twitter_Client')->disableOriginalConstructor()
            ->setMethods(['getUrlLength'])->getMock();
        $client->expects($this->any())->method('getUrlLength')->willReturn(20);
        /** @var Denkmal_Twitter_Client $client */

        $eventTweeter = new Denkmal_Twitter_EventTweeter($client, $render);

        $venue = Denkmal_Model_Venue::create('Example', false, false);
        $event = Denkmal_Model_Event::create($venue, $description, true, false, $from, $until);
        $this->assertSame($expected, $eventTweeter->getEventText($event, $maxLength));
    }
}
