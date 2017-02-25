<?php

class Denkmal_Page_EventsTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testVenueBookmarks() {
        $region = Denkmal_Model_Region::findBySlug('basel');
        $venue1 = DenkmalTest_TH::createVenue('Venue 1', null, null, $region);
        $venue2 = DenkmalTest_TH::createVenue('Venue 2', null, null, $region);
        $venue3 = DenkmalTest_TH::createVenue('Venue 3', null, null, $region);

        $page = new Denkmal_Page_Events();
        $site = new Denkmal_Site_Region_Basel();
        $host = parse_url($site->getUrl(), PHP_URL_HOST);
        $request = new CM_Http_Request_Get('', [
            'Host'   => $host,
            'Cookie' => 'venue-bookmarks=' . CM_Util::jsonEncode([$venue1->getId(), $venue3->getId()]),
        ]);
        $response = new CM_Http_Response_Page($request, $site, $this->getServiceManager());
        $page->prepareResponse($response->getRender()->getEnvironment(), $response);
        $renderAdapter = new CM_RenderAdapter_Page($response->getRender(), $page);

        $html = new CM_Dom_NodeList($renderAdapter->fetch(), true);

        $this->assertTrue($html->has('[venue-id="' . $venue1->getId() . '"] .venue-bookmark[bookmarked]'));
    }

}
