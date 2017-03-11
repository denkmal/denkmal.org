<?php

class Denkmal_Component_EventDetailsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $venue = DenkmalTest_TH::createVenue('My Venue');
        $event = Denkmal_Model_Event::create($venue, 'My Event', true, true, new DateTime('2017-01-01'));
        $component = new Denkmal_Component_EventDetails(['event' => $event]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertContains('My Venue', $html->find('.event-description .venue')->getText());
        $this->assertContains('My Event', $html->find('.event-description .details')->getText());
    }

    public function testMapLink() {
        $venue = DenkmalTest_TH::createVenue('My Venue', null, null, null, null, null, new CM_Geo_Point(12, 13));
        $event = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-01 18:11:31'));

        $component = new Denkmal_Component_EventDetails(['event' => $event]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertTrue($html->has('.button-location'));
        $this->assertSame('https://www.google.com/maps?q=My+Venue%4012%2C13', $html->find('.button-location')->getAttribute('href'));
    }

}
