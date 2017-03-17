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

    public function testProcessEventDataList() {
        /** @var Denkmal_Scraper_Manager|Mocka\ClassMock $manager */
        $manager = $this->mockObject('Denkmal_Scraper_Manager');
        $manager->mockMethod('getNow')->set(new DateTime('2017-02-18'));

        $region = DenkmalTest_TH::createRegion();
        $venue = DenkmalTest_TH::createVenue('foo', false, false, $region);

        $manager->processEventDataList([
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 1'),
                new DateTime('2017-02-19 19:00'), null,
                'source-1'
            ),
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 2'),
                new DateTime('2017-02-19 19:00'), null,
                'source-1'
            ),
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 3'),
                new DateTime('2017-02-20 19:00'), null,
                'source-2'
            ),
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 3 copy'),
                new DateTime('2017-02-20 19:00'), null,
                'source-3'
            )
        ]);

        $this->assertCount(3, $venue->getEventList());

        $manager->processEventDataList([
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 1'),
                new DateTime('2017-02-19 19:00'), null,
                'source-4',
                ['Facebook Event' => 'http://facebook.com/event-1']
            ),
            new Denkmal_Scraper_EventData($region, $venue,
                new Denkmal_Scraper_Description('my event 3'),
                new DateTime('2017-02-20 19:00'), null,
                'source-4',
                ['Facebook Event' => 'http://facebook.com/event-3']
            ),
        ]);

        $this->assertCount(3, $venue->getEventList());

        /** @var Denkmal_Model_Event[] $eventList1 */
        $eventList1 = (new Denkmal_Paging_Event_VenueDate(new DateTime('2017-02-19'), $venue, true))->getItems();
        $this->assertCount(2, $eventList1);
        foreach ($eventList1 as $event) {
            $this->assertSame(0, $event->getLinks()->getCount(), 'Links should not be set, because multiple events exist on this day');
        }

        /** @var Denkmal_Model_Event[] $eventList2 */
        $eventList2 = (new Denkmal_Paging_Event_VenueDate(new DateTime('2017-02-20'), $venue, true))->getItems();
        $this->assertCount(1, $eventList2);
        foreach ($eventList2 as $event) {
            $this->assertSame(1, $event->getLinks()->getCount());
        }
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
