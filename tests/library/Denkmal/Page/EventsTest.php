<?php

class Denkmal_Page_EventsTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testVenueBookmarks() {
        $date = new DateTime('2017-01-01 20:00');
        $region = Denkmal_Model_Region::findBySlug('basel');

        $venue1 = DenkmalTest_TH::createVenue('Venue 1', null, null, $region);
        $event1 = Denkmal_Model_Event::create($venue1, 'Event 1', true, true, $date);

        $venue2 = DenkmalTest_TH::createVenue('Venue 2', null, null, $region);
        $event2 = Denkmal_Model_Event::create($venue2, 'Event 2', true, true, $date);

        $venue3 = DenkmalTest_TH::createVenue('Venue 3', null, null, $region);
        $event3 = Denkmal_Model_Event::create($venue3, 'Event 3', true, true, $date);

        $page = new Denkmal_Page_Events(['date' => $date]);
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

        $this->assertSame('', $html->find('.venue-bookmark[data-venue-id="' . $venue1->getId() . '"]')->getAttribute('data-bookmarked'));
        $this->assertSame(null, $html->find('.venue-bookmark[data-venue-id="' . $venue2->getId() . '"]')->getAttribute('data-bookmarked'));
        $this->assertSame('', $html->find('.venue-bookmark[data-venue-id="' . $venue3->getId() . '"]')->getAttribute('data-bookmarked'));
    }

}
