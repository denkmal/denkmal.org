<?php

class Denkmal_Scraper_ManagerTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testIsValidEvent() {
        $region = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue(null, null, null, $region);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($region, $venue, $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(true, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventVenueIgnore() {
        $region = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue('foo', false, true, $region);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($region, $venue, $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
    }

    public function testIsValidEventVenueNameEmpty() {
        $region = DenkmalTest_TH::createRegion();
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($region, '', $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Manager', '_isValidEvent');
        $this->assertSame(false, $method->invoke($manager, $eventData));
    }

    public function testIsExistingEvent() {
        $region = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue('foo', false, false, $region);
        $description = new Denkmal_Scraper_Description('foo');
        $from = $this->_getDate()->add(new DateInterval('PT1H'));
        $until = $this->_getDate()->add(new DateInterval('PT2H'));
        $eventData = new Denkmal_Scraper_EventData($region, $venue, $description, $from, $until);

        $manager = new Denkmal_Scraper_Manager();
        $this->assertSame(false, CMTest_TH::callProtectedMethod($manager, '_hasExistingEvent', [$eventData]));

        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $from);
        $this->assertSame(true, CMTest_TH::callProtectedMethod($manager, '_hasExistingEvent', [$eventData]));
    }

    public function testIsExistingEventBeforeNewEvent() {
        $region = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue('foo', false, false, $region);
        $description = new Denkmal_Scraper_Description('foo');
        $date = $this->_getDate();
        $date->setTime(23, 0);
        $eventData = new Denkmal_Scraper_EventData($region, $venue, $description, $date);

        $dateExisting = clone $date;
        $dateExisting->setTime(22, 0);
        $eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $dateExisting);

        $manager = new Denkmal_Scraper_Manager();
        $this->assertSame(true, CMTest_TH::callProtectedMethod($manager, '_hasExistingEvent', [$eventData]));
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
