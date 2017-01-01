<?php

class Denkmal_Component_EventDetailsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $venue = DenkmalTest_TH::createVenue('My Venue', null, null, null, null, null, new CM_Geo_Point(12, 13));
        $component = new Denkmal_Component_EventDetails(['venue' => $venue]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertTrue($html->has('a.location'));
        $this->assertSame('https://www.google.com/maps?ll=12%2C13&q=My+Venue', $html->find('a.location')->getAttribute('href'));
    }

    public function testSecretVenue() {
        $venue = DenkmalTest_TH::createVenue();
        $venue->setSecret(true);
        $component = new Denkmal_Component_EventDetails(['venue' => $venue]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertFalse($html->has('a.location'));
    }
}
