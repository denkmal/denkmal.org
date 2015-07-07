<?php

class Denkmal_Component_EventDetailsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $venue = Denkmal_Model_Venue::create('My name', false, false, 'http://example.com', 'My address', new CM_Geo_Point(12, 13));
        $component = new Denkmal_Component_EventDetails(['venue' => $venue]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertTrue($html->has('a.location'));
        $this->assertSame('https://www.google.com/maps/?q=12,13', $html->find('a.location')->getAttribute('href'));
    }

    public function testSecretVenue() {
        $venue = Denkmal_Model_Venue::create('My name', false, false, 'http://example.com', 'My address', new CM_Geo_Point(12, 13));
        $venue->setSecret(true);
        $component = new Denkmal_Component_EventDetails(['venue' => $venue]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertFalse($html->has('a.location'));
    }
}
