<?php

class Denkmal_Scraper_Source_AbstractTest extends CMTest_TestCase {

	protected function tearDown() {
		CMTest_TH::clearEnv();
	}

	/**
	 * @return DateTime
	 */
	private function _getNow() {
		return new DateTime();
	}

	public function testIsValidEvent() {
		$venue = Denkmal_Model_Venue::create('foo', false, false);
		$description = new Denkmal_Scraper_Description('foo');
		$from = $this->_getNow()->add(new DateInterval('PT1H'));
		$until = $this->_getNow()->add(new DateInterval('PT2H'));

		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
		$this->assertSame(true, $method->invoke($scraper, $venue, $description, $from, $until));
	}

	public function testAddEventAndVenueIgnore() {
		$venue = $this->getMockBuilder('Denkmal_Model_Venue')->setMethods(array('getIgnore'))->getMock();
		$venue->expects($this->any())->method('getIgnore')->will($this->returnValue(true));
		/** @var Denkmal_Model_Venue $venue */
		$description = new Denkmal_Scraper_Description('foo');
		$from = $this->_getNow()->add(new DateInterval('PT1H'));
		$until = $this->_getNow()->add(new DateInterval('PT2H'));

		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
		$this->assertSame(false, $method->invoke($scraper, $venue, $description, $from, $until));
	}

	public function testAddEventAndVenueExistingEvent() {
		$venue = Denkmal_Model_Venue::create('foo', false, false);
		$description = new Denkmal_Scraper_Description('foo');
		$from = $this->_getNow()->add(new DateInterval('PT1H'));
		$until = $this->_getNow()->add(new DateInterval('PT2H'));
		$eventExisting = Denkmal_Model_Event::create($venue, 'bar', false, false, $from);

		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->setMethods(array('_addEvent'))->getMockForAbstractClass();
		$scraper->expects($this->never())->method('_addEvent');
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$scraper = $this->getMockBuilder('Denkmal_Scraper_Source_Abstract')->getMockForAbstractClass();
		/** @var Denkmal_Scraper_Source_Abstract $scraper */

		$method = CMTest_TH::getProtectedMethod('Denkmal_Scraper_Source_Abstract', '_isValidEvent');
		$this->assertSame(false, $method->invoke($scraper, $venue, $description, $from, $until));
	}
}
