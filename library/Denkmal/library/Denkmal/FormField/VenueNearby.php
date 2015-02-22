<?php

class Denkmal_FormField_VenueNearby extends CM_FormField_Abstract {

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        return new Denkmal_Model_Venue($userInput);
    }

    public function ajax_getVenuesByCoordinates(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $lat = $params->getFloat('lat');
        $lon = $params->getFloat('lon');
        $geoPoint = new CM_Geo_Point($lat, $lon);

        $venueList = new Denkmal_Paging_Venue_GeoPoint($geoPoint, 200);

        return Functional\map($venueList->getItems(), function (Denkmal_Model_Venue $venue) {
            return [
                'id'   => $venue->getId(),
                'name' => $venue->getName(),
            ];
        });
    }
}
