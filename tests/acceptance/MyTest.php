<?php

class MyTest extends CMTest_TestCase {

    /** @var \RemoteWebDriver */
    protected $_driver;

    protected function setUp() {
        $capabilities = new \DesiredCapabilities([\WebDriverCapabilityType::BROWSER_NAME => 'phantomjs']);
        $this->_driver = \RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    protected function tearDown() {
        $this->_driver->close();
    }

    public function testAddPage() {
        $this->_driver->get('http://www.denkmal.dev/');

        $this->_driver->findElement(WebDriverBy::cssSelector('a.addButton'))->click();
        $this->_driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('.Denkmal_Page_Add')));

        $this->stringContains('Event hinzufügen', $this->_driver->findElement(WebDriverBy::cssSelector('h1'))->getText());
        $this->stringContains('/add', $this->_driver->getCurrentURL());

        $this->_driver->takeScreenshot(DIR_ROOT . '/screenshot.png');
    }

    public function testNewEvent() {
        $this->_driver->get('http://www.denkmal.dev/add');

        $this->_driver->findElement(WebDriverBy::cssSelector('#s2id_autogen2'))->sendKeys('My venue' . time());
        $this->_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.select2-highlighted')));
        $this->_driver->findElement(WebDriverBy::cssSelector('.select2-highlighted'))->click();
        $this->_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('[name="venueAddress"]')));

        $this->_driver->findElement(WebDriverBy::cssSelector('[name="venueAddress"]'))->sendKeys('My Address 1');
        $this->_driver->findElement(WebDriverBy::cssSelector('[name="venueUrl"]'))->sendKeys('http://www.example.com/');
        (new \WebDriverSelect($this->_driver->findElement(WebDriverBy::cssSelector('[name="date[year]"]'))))->selectByValue('2015');
        (new \WebDriverSelect($this->_driver->findElement(WebDriverBy::cssSelector('[name="date[month]"]'))))->selectByValue('3');
        (new \WebDriverSelect($this->_driver->findElement(WebDriverBy::cssSelector('[name="date[day]"]'))))->selectByValue('4');
        $this->_driver->findElement(WebDriverBy::cssSelector('[name="fromTime"]'))->clear()->sendKeys('20:30');
        $this->_driver->findElement(WebDriverBy::cssSelector('[name="title"]'))->sendKeys('My Title');

        $this->_driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.Denkmal_Component_EventPreview')));

        $this->stringContains('My Venue', $this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Component_EventPreview .event-location'))->getText());
        $this->stringContains('My Title', $this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Component_EventPreview .event-details'))->getText());
        $this->stringContains('21:30', $this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Component_EventPreview .time'))->getText());

        $this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Form_EventAdd'))->submit();
        $this->_driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();
        $this->_driver->wait()->until(function (RemoteWebDriver $driver) {
            return $driver->executeScript('return !$.active;');
        });
        usleep(0.5 * 1000000);

        $this->assertTrue($this->_driver->findElement(WebDriverBy::cssSelector('.formSuccess'))->isDisplayed());
        $this->assertFalse($this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Form_EventAdd .preview'))->isDisplayed());
        $this->assertFalse($this->_driver->findElement(WebDriverBy::cssSelector('.Denkmal_Form_EventAdd .formWrapper'))->isDisplayed());
    }
}
