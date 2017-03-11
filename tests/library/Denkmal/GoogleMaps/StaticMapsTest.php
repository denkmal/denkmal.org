<?php

class Denkmal_GoogleMaps_StaticMapsTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetUrl() {
        $staticMaps = new Denkmal_GoogleMaps_StaticMaps('my-api-key');

        $this->assertSame(
            'https://maps.googleapis.com/maps/api/staticmap?key=my-api-key&zoom=12&format=jpg&size=300x200&markers=color%3A0xD60725%7C12%2C13',
            $staticMaps->getUrl(new CM_Geo_Point(12, 13), 300, 200, 12));
    }

    public function testGetUrlWithStyles() {
        $staticMaps = new Denkmal_GoogleMaps_StaticMaps('my-api-key');

        $styles = [
            [
                'featureType' => 'administrative',
                'elementType' => 'all',
                'stylers'     => [
                    ['visibility' => 'simplified'],
                    ['color' => '#00ff00'],
                ]
            ],
            [
                'stylers' => [
                    ['color' => '#ff0000'],
                ]
            ],
        ];

        $this->assertSame(
            'https://maps.googleapis.com/maps/api/staticmap?key=my-api-key&zoom=12&format=jpg&size=300x200&markers=color%3A0xD60725%7C12%2C13&style=feature%3Aadministrative%7Celement%3Aall%7Cvisibility%3Asimplified%7Ccolor%3A0x00ff00&style=feature%3Aall%7Ccolor%3A0xff0000',
            $staticMaps->getUrl(new CM_Geo_Point(12, 13), 300, 200, 12, $styles));
    }
}
