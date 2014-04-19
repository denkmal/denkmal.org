<?php

class Denkmal_Scraper_Source_AbstractTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testIsValidEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
        /** @var Denkmal_Scraper_Source_Abstract $scraper */

        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
        $this->assertSame(true, $method->invoke($scraper, $venue, $description, $from, $until));
    }

    public function testIsValidEventVenueIgnore() {
        $venue = $this->getMockBuilder('Denkmal_Model_Venue')->setMethods(array('getIgnore'))->getMock();
        $venue->expects($this->any())->method('getIgnore')->will($this->returnValue(true));
        /** @var Denkmal_Model_Venue $venue */
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
        /** @var Denkmal_Scraper_Source_Abstract $scraper */

        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
        $this->assertSame(false, $method->invoke($scraper, $venue, $description, $from, $until));
    }

    public function testIsValidEventExistingEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $from);

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
        /** @var Denkmal_Scraper_Source_Abstract $scraper */

        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
        $this->assertSame(false, $method->invoke($scraper, $venue, $description, $from, $until));
    }

    public function testIsValidEventExistingEventBeforeNewEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');

        $date = $this->_getDate();
        $date->setTime(23, 0);

        $dateExisting = clone $date;
        $dateExisting->setTime(22, 0);
        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $dateExisting);

        $scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
        /** @var Denkmal_Scraper_Source_Abstract $scraper */

        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
        $this->assertSame(false, $method->invoke($scraper, $venue, $description, $date));
    }

    /**
     * @return DateTime
     */
    private function _getDate() {
        $date = new DateTime();
        $date->add(new DateInterval('P1D'));
        $date->setTime(12, 0);
        return $date;
    }
}
