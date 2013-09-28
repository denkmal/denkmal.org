<?php

class Denkmal_Scraper_Source_AbstractTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	public function testAddEventAndVenue() {
		$venue = Denkmal_Model_Venue::create('foo', false, false);
		$description = 'foo';
		$from = new DateTime('2013-01-01 1:00:00');
		$until = new DateTime('2013-01-01 12:00:00');

		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->setMethods(array('_addEvent'))->getMockForAbstractClass();
		$scraper->expects($this->once())->method('_addEvent')->with($venue, new Denkmal_Scraper_Description($description), $from, $until);
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_addEventAndVenue');
		$method->invoke($scraper, $venue, $description, $from, $until);
	}

	public function testAddEventAndVenueIgnore() {
		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->setMethods(array('_addEvent'))->getMockForAbstractClass();
		$scraper->expects($this->never())->method('_addEvent');
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$venue = $this->getMockBuilder('Denkmal_Model_Venue')->setMethods(array('getIgnore'))->getMock();
		$venue->expects($this->any())->method('getIgnore')->will($this->returnValue(true));
		/** @var Denkmal_Model_Venue $venue */

		$description = 'foo';
		$from = new DateTime();

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_addEventAndVenue');
		$method->invoke($scraper, $venue, $description, $from);
	}

	public function testAddEventAndVenueExistingEvent() {
		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->setMethods(array('_addEvent'))->getMockForAbstractClass();
		$scraper->expects($this->never())->method('_addEvent');
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$venue = Denkmal_Model_Venue::create('foo', false, false);
		$eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, new DateTime('2013-01-01 1:00:00'));
		$description = 'foo';
		$from = new DateTime('2013-01-01 1:00:00');

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_addEventAndVenue');
		$method->invoke($scraper, $venue, $description, $from);
	}
}
