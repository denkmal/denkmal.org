<?php
// Docu: https://developers.google.com/maps/documentation/staticmaps/

function smarty_function_googlemaps_img(array $params, Smarty_Internal_Template $template) {
    if (empty($params['coordinates'])) {
        throw new CM_Exception('Param coordinates are required');
    }
    /** @var CM_Geo_Point $coordinates */
    $coordinates = $params['coordinates'];

    $mapsParams = new Denkmal_GoogleMaps_StaticMapsParams();

    return $mapsParams->getParams($coordinates, $params);
}
