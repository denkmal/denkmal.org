<?php

class Denkmal_Scraper_ManagerTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testIsValidEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($venue, $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(true, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventVenueIgnore() {
        $venue = Denkmal_Model_Venue::create('foo', false, true);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($venue, $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventExistingEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($venue, $description, $from, $until);

        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $from);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventExistingEventBeforeNewEvent() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $description = new Denkmal_Scraper_Description('foo');
        $date = $this->_getDate();
        $date->setTime(23, 0);
        $eventData = new Denkmal_Scraper_EventData($venue, $description, $date);

        $dateExisting = clone $date;
        $dateExisting->setTime(22, 0);
        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $dateExisting);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventVenueNameEmpty() {
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData('', $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
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
