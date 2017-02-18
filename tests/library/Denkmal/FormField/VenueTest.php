<?php

class Denkmal_FormField_VenueTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testAjax_getSuggestions() {
        $venue1 = DenkmalTest_TH::createVenue('Foo', false, false);
        $venue2 = DenkmalTest_TH::createVenue('My Foo', false, false);
        $venue3 = DenkmalTest_TH::createVenue('Foo Bar', false, false);
        $venue4 = DenkmalTest_TH::createVenue('Something Bar', false, false);

        $formField = new Denkmal_FormField_Venue();
        $environment = new CM_Frontend_Environment();
        $render = new CM_Frontend_Render($environment);
        $response = $this->getResponseAjax($formField, 'getSuggestions', ['options' => [], 'term' => 'foo'], $environment);

        $this->assertViewResponseSuccess($response);
        $suggestionList = CM_Params::decode($response->getContent(), true)['success']['data'];

        $this->assertEquals($suggestionList, [
            $formField->getSuggestion($venue1, $render),
            $formField->getSuggestion($venue3, $render),
            $formField->getSuggestion($venue2, $render),
        ]);
    }
}
