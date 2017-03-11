<?php

function smarty_function_googlemaps_img(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');

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

    $zoom = 14;
    if (isset($params['zoom'])) {
        $zoom = (int) $params['zoom'];
    }

    $styles = null;
    if (isset($params['styleFile'])) {
        $styleFile = $render->getLayoutFile('resource/' . $params['styleFile']);
        $styles = CM_Util::jsonDecode($styleFile->read());
    }

    /** @var Denkmal_GoogleMaps_StaticMaps $staticMaps */
    $staticMaps = $render->getServiceManager()->get('google-static-maps', 'Denkmal_GoogleMaps_StaticMaps');

    return $staticMaps->getUrl($coordinates, $width, $height, $zoom, $styles);
}
