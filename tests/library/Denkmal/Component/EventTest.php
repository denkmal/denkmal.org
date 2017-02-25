<?php

class Denkmal_Component_EventTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $venue = DenkmalTest_TH::createVenue('My Venue');
        $event = Denkmal_Model_Event::create($venue, 'My Event', true, true, new DateTime('2017-01-01'));
        $component = new Denkmal_Component_Event(['event' => $event]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertContains('My Venue', $html->find('.event-description .venue')->getText());
        $this->assertContains('My Event', $html->find('.event-description .details')->getText());
    }

    public function testRenderWithoutPersistence() {
        $venue = new Denkmal_Model_Venue();
        $venue->setName('My Venue');

        $event = new Denkmal_Model_Event();
        $event->setDescription('My Event');
        $event->setGenres(null);
        $event->setStarred(false);
        $event->setSong(null);
        $event->setFrom(new DateTime('2017-01-01 02:00'));
        $event->setUntil(null);

        $component = new Denkmal_Component_Event(['event' => $event, 'venue' => $venue]);
        $html = $this->_renderComponent($component);

        $this->assertComponentAccessible($component);
        $this->assertContains('My Venue', $html->find('.event-description .venue')->getText());
        $this->assertContains('My Event', $html->find('.event-description .details')->getText());
    }

}
