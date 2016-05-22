<?php

class Denkmal_Paging_Venue_HasEventsWithinTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue1 = DenkmalTest_TH::createVenue('Foo 1');
        $event1 = Denkmal_Model_Event::create($venue1, 'Foo 1', true, false, $this->_getDateFromNow(new DateInterval('PT0H')));
        $venue2 = DenkmalTest_TH::createVenue('Foo 2');
        $event2 = Denkmal_Model_Event::create($venue2, 'Foo 2', true, false, $this->_getDateFromNow(new DateInterval('PT2H')));
        $venue3 = DenkmalTest_TH::createVenue('Foo 3');
        $event3 = Denkmal_Model_Event::create($venue3, 'Foo 3', true, false, $this->_getDateFromNow(new DateInterval('P1D')));
        $venue4 = DenkmalTest_TH::createVenue('Foo 4');
        $event4 = Denkmal_Model_Event::create($venue4, 'Foo 4', true, false, $this->_getDateFromNow(new DateInterval('P6D')));
        $event4b = Denkmal_Model_Event::create($venue4, 'Foo 4b', true, false, $this->_getDateFromNow(new DateInterval('P6D')));
        $venue5 = DenkmalTest_TH::createVenue('Foo 5');
        $event5 = Denkmal_Model_Event::create($venue5, 'Foo 5', true, false, $this->_getDateFromNow(new DateInterval('P6DT5H')));
        $venue6 = DenkmalTest_TH::createVenue('Foo 6');
        $event6 = Denkmal_Model_Event::create($venue5, 'Foo 6', true, false, $this->_getDateFromNow(new DateInterval('P7D')));
        $venue7 = DenkmalTest_TH::createVenue('Foo 7');
        $event8 = Denkmal_Model_Event::create($venue6, 'Foo 7', true, false, $this->_getDateFromNow(new DateInterval('P8D')));

        $settings = new Denkmal_App_Settings();
        $dateStart = $settings->getCurrentDate();
        $dateEnd = $settings->getCurrentDate();
        $dateEnd->add(new DateInterval('P6D'));

        $paging = new Denkmal_Paging_Venue_HasEventsWithin($dateStart, $dateEnd);
        $this->assertEquals(array($venue1, $venue2, $venue3, $venue4, $venue5), $paging);
    }

    /**
     * @param DateInterval $interval
     * @return DateTime
     */
    private function _getDateFromNow(DateInterval $interval) {
        $settings = new Denkmal_App_Settings();
        $date = $settings->getCurrentDate();
        $date->setTime($settings->getDayOffset(), 0, 0);
        $date->add($interval);
        return $date;
    }
}
