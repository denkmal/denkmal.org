<?php

class MyTest extends CMTest_TestCase {

    /** @var \WebNavigator\Navigator */
    private $_navigator;

    protected function setUp() {
        $capabilities = new \DesiredCapabilities([\WebDriverCapabilityType::BROWSER_NAME => 'phantomjs']);
        $driver = \RemoteWebDriver::create('http://10.0.3.8:4444/wd/hub', $capabilities);
        $this->_navigator = new \WebNavigator\Navigator($driver, 'https://www.denkmal.dev');
    }

    protected function tearDown() {
        if (isset($this->_navigator)) {
            $this->_navigator->quit();
        }
    }

    public function testAddPage() {
        $this->_navigator->get('/events');

        $this->_navigator->click('.addButton a');
        $this->_navigator->waitForElement('.Denkmal_Page_Add');
        $this->assertContains('Event hinzufügen', $this->_navigator->getText('h1'));
        $this->assertContains('/add', $this->_navigator->getUrl());

        $this->_navigator->takeScreenshot(DIR_ROOT . '/screenshot.png');
    }

    public function testNewEvent() {
        $this->_navigator->get('/add');

        $this->_navigator->setField('.Denkmal_FormField_Venue .select2-input', 'My Venue' . time());
        $this->_navigator->waitForAjax();

        $this->_navigator->click('.select2-results > .select2-result');
        $this->_navigator->waitForElement('[name="venueAddress"]');

        $date = new DateTime();
        $this->_navigator->setField('[name="venueAddress"]', 'My Address 1');
        $this->_navigator->setField('[name="venueUrl"]', 'http://www.example.com/');
        $this->_navigator->setField('[name="date[year]"]', $date->format('Y'));
        $this->_navigator->setField('[name="date[month]"]', $date->format('n'));
        $this->_navigator->setField('[name="date[day]"]', $date->format('j'));
        $this->_navigator->setField('[name="fromTime"]', '20:30');
        $this->_navigator->setField('[name="title"]', 'My Title');

        usleep(1000000 * 0.2); // Preview update is debounced
        $this->_navigator->waitForAjax();
        $this->assertContains('My Venue', $this->_navigator->getText('.Denkmal_Component_EventPreview .event-location'));
        $this->assertContains('My Title', $this->_navigator->getText('.Denkmal_Component_EventPreview .event-details'));
        $this->assertContains('20:30', $this->_navigator->getText('.Denkmal_Component_EventPreview .time'));

        $this->assertNotContains('Der Event wurde hinzugefügt', $this->_navigator->getText('body'));
        $this->_navigator->click('button[type="submit"]');
        $this->_navigator->waitForAjax();
        $this->assertContains('Der Event wurde hinzugefügt', $this->_navigator->getText('body'));
    }
}
