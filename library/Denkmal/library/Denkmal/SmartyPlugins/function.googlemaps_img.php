<?php
// Docu: https://developers.google.com/maps/documentation/staticmaps/

function smarty_function_googlemaps_img(array $params, Smarty_Internal_Template $template) {
    if (empty($params['coordinates'])) {
        throw new CM_Exception('Param coordinates are required');
    }
    /** @var CM_Geo_Point $coordinates */
    $coordinates = $params['coordinates'];

    $width = 640;
    if (isset($params['width'])) {
        $width = (int) $params['width'];
    }

    $height = 400;
    if (isset($params['height'])) {
        $height = (int) $params['height'];
    }

    $zoom = 15;
    if (isset($params['zoom'])) {
        $zoom = $params['zoom'];
    }

    $mapStyles = '';
    if (isset($params['jsonStyles'])) {
        $styles = Denkmal_GoogleMaps_JsonToStaticParams::create($params['jsonStyles']);
        $mapStyles = '&style=' . join('&style=', $styles);
    }

    $linkParams['key'] = CM_Config::get()->googleApi;
    $linkParams['zoom'] = $zoom;
    $linkParams['format'] = 'jpg';
    $linkParams['size'] = $width . 'x' . $height;
    $linkParams['markers'] = 'color:0xD60725|' . $coordinates->getLatitude() . ',' . $coordinates->getLongitude();

    return CM_Util::link('https://maps.googleapis.com/maps/api/staticmap', $linkParams) . CM_Params::encode($mapStyles);
}
