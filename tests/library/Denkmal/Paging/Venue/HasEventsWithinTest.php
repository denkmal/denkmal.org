<?php

class Denkmal_Paging_Venue_HasEventsWithinTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $venue1 = Denkmal_Model_Venue::create('Foo 1', true, false);
        $event1 = Denkmal_Model_Event::create($venue1, 'Foo 1', true, false, $this->_getDateFromNow(new DateInterval('PT0H')));
        $venue2 = Denkmal_Model_Venue::create('Foo 2', true, false);
        $event2 = Denkmal_Model_Event::create($venue2, 'Foo 2', true, false, $this->_getDateFromNow(new DateInterval('PT2H')));
        $venue3 = Denkmal_Model_Venue::create('Foo 3', true, false);
        $event3 = Denkmal_Model_Event::create($venue3, 'Foo 3', true, false, $this->_getDateFromNow(new DateInterval('P1D')));
        $venue4 = Denkmal_Model_Venue::create('Foo 4', true, false);
        $event4 = Denkmal_Model_Event::create($venue4, 'Foo 4', true, false, $this->_getDateFromNow(new DateInterval('P6D')));
        $event4b = Denkmal_Model_Event::create($venue4, 'Foo 4b', true, false, $this->_getDateFromNow(new DateInterval('P6D')));
        $venue5 = Denkmal_Model_Venue::create('Foo 5', true, false);
        $event5 = Denkmal_Model_Event::create($venue5, 'Foo 5', true, false, $this->_getDateFromNow(new DateInterval('P6DT5H')));
        $venue6 = Denkmal_Model_Venue::create('Foo 6', true, false);
        $event6 = Denkmal_Model_Event::create($venue5, 'Foo 6', true, false, $this->_getDateFromNow(new DateInterval('P7D')));
        $venue7 = Denkmal_Model_Venue::create('Foo 7', true, false);
        $event8 = Denkmal_Model_Event::create($venue6, 'Foo 7', true, false, $this->_getDateFromNow(new DateInterval('P8D')));

        $dateStart = Denkmal_Site::getCurrentDate();
        $dateEnd = Denkmal_Site::getCurrentDate();
        $dateEnd->add(new DateInterval('P6D'));
        echo $dateStart->format('Y-m-d H:i:s') . PHP_EOL;
        echo $dateEnd->format('Y-m-d H:i:s') . PHP_EOL;

        $paging = new Denkmal_Paging_Venue_HasEventsWithin($dateStart, $dateEnd);
        $this->assertEquals(array($venue1, $venue2, $venue3, $venue4, $venue5), $paging);
    }

    /**
     * @param DateInterval $interval
     * @return DateTime
     */
    private function _getDateFromNow(DateInterval $interval) {
        $date = Denkmal_Site::getCurrentDate();
        $date->setTime(Denkmal_Site::getDayOffset(), 0, 0);
        $date->add($interval);
        return $date;
    }
}
