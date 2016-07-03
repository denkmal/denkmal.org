<?php

class Denkmal_EventTweeter_DailyTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRun() {
        $region = DenkmalTest_TH::createRegion('basel', 'basel');
        $venue = DenkmalTest_TH::createVenue(null, null, null, $region);
        $event1 = Denkmal_Model_Event::create($venue, 'Foo 1', true, false, new DateTime('2014-11-01 11:00'), null, null, null, true);
        $event2 = Denkmal_Model_Event::create($venue, 'Foo 2', true, false, new DateTime('2014-11-01 12:00'), null, null, null, false);
        $event3 = Denkmal_Model_Event::create($venue, 'Foo 3', true, false, new DateTime('2014-11-01 13:00'), null, null, null, true);
        $event4 = Denkmal_Model_Event::create($venue, 'Foo 4', true, false, new DateTime('2014-11-01 14:00'), null, null, null, true);
        $event5 = Denkmal_Model_Event::create($venue, 'Foo 5', true, false, new DateTime('2014-11-01 15:00'), null, null, null, true);
        $event6 = Denkmal_Model_Event::create($venue, 'Foo 5', true, false, new DateTime('2014-11-02 20:00'), null, null, null, true);

        /** @var Denkmal_EventTweeter_EventTweeter|\Mocka\AbstractClassTrait $eventTweeter */
        $eventTweeter = $this->mockClass('Denkmal_EventTweeter_EventTweeter')->newInstanceWithoutConstructor();
        $eventTweeter->mockMethod('sendTweet')->at(0, function (Denkmal_Model_Event $event) use ($event1) {
            $this->assertEquals($event1, $event);
        });
        $eventTweeter->mockMethod('sendTweet')->at(1, function (Denkmal_Model_Event $event) use ($event3) {
            $this->assertEquals($event3, $event);
        });
        $eventTweeter->mockMethod('sendTweet')->at(2, function (Denkmal_Model_Event $event) use ($event4) {
            $this->assertEquals($event4, $event);
        });

        /** @var Denkmal_EventTweeter_Daily|\Mocka\AbstractClassTrait $tweeterDaily */
        $tweeterDaily = $this->mockObject('Denkmal_EventTweeter_Daily');
        $tweeterDaily->mockMethod('_getEventTweeter')->set($eventTweeter);

        $tweeterDaily->run(new DateTime('2014-11-01'));
    }
}
