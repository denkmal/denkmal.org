<?php

class Denkmal_FormField_VenueNearby extends CM_FormField_Abstract {

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        return new Denkmal_Model_Venue($userInput);
    }

    public function prepare(CM_Params $renderParams, CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $viewResponse->set('labelPrefix', $renderParams->has('labelPrefix') ? $renderParams->getString('labelPrefix') : null);
    }

    public function ajax_getVenuesByCoordinates(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $lat = $params->getFloat('lat');
        $lon = $params->getFloat('lon');
        $radius = $params->getFloat('radius', 100);
        $radius = max(50, min(500, $radius));
        $geoPoint = new CM_Geo_Point($lat, $lon);

        $venueList = new Denkmal_Paging_Venue_GeoPoint($geoPoint, $radius);

        return Functional\map($venueList->getItems(), function (Denkmal_Model_Venue $venue) {
            return [
                'id'   => $venue->getId(),
                'name' => $venue->getName(),
            ];
        });
    }
}
