<?php

class Denkmal_Paging_Venue_BookmarksTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $region = DenkmalTest_TH::createRegion();

        $venue1 = DenkmalTest_TH::createVenue('Venue 1', null, null, $region);
        $venue2 = DenkmalTest_TH::createVenue('Venue 2', null, null, $region);
        $venue3 = DenkmalTest_TH::createVenue('Venue 3', null, null, $region);

        $cookie = CM_Util::jsonEncode([$venue1->getId(), (string) $venue2->getId()]);
        $this->assertEquals([$venue1, $venue2], new Denkmal_Paging_Venue_Bookmarks($cookie));
    }

    public function testGetItemsEmptyCookie() {
        $cookie = '';
        $this->assertEquals([], new Denkmal_Paging_Venue_Bookmarks($cookie));
    }

    public function testGetItemsInvalidCookie() {
        $cookie = '{xyz';
        $this->assertEquals([], new Denkmal_Paging_Venue_Bookmarks($cookie));
    }

    public function testGetItemsInvalidCookieItem() {
        $cookie = CM_Util::jsonEncode([12, '13', ['foo' => 'bar']]);
        $this->assertEquals([], new Denkmal_Paging_Venue_Bookmarks($cookie));
    }

}
