<?php

class Denkmal_FormField_VenueTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testAjax_getSuggestions() {
        $venue1 = Denkmal_Model_Venue::create('Foo', false, false);
        $venue2 = Denkmal_Model_Venue::create('My Foo', false, false);
        $venue3 = Denkmal_Model_Venue::create('Foo Bar', false, false);
        $venue4 = Denkmal_Model_Venue::create('Something Bar', false, false);

        $formField = new Denkmal_FormField_Venue();
        $environment = new CM_Frontend_Environment();
        $render = new CM_Frontend_Render($environment);
        $response = $this->getResponseAjax($formField, 'getSuggestions', ['options' => [], 'term' => 'foo'], $environment);

        $this->assertViewResponseSuccess($response);
        $suggestionList = CM_Params::decode($response->getContent(), true)['success']['data'];

        $this->assertEquals($suggestionList, [
            $formField->getSuggestion($venue1, $render),
            $formField->getSuggestion($venue3, $render),
        ]);
    }
}
