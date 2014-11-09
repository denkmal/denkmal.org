<?php

class Denkmal_Twitter_EventTweeterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
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
