<?php
// Docu: https://developers.google.com/maps/documentation/staticmaps/

function smarty_function_googlemaps_img(array $params, Smarty_Internal_Template $template) {

	if (empty($params['coordinates'])) {
		throw new CM_Exception('Param coordinates are required');
	}
	/** @var CM_Geo_Point $coordinates */
	$coordinates = $params['coordinates'];

	$width = 400;
	if (isset($params['width'])) {
		$width = (int) $params['width'];
	}

	$height = 400;
	if (isset($params['height'])) {
		$height = (int) $params['height'];
	}

	$zoom = 14;
	if (isset($params['zoom'])) {
		$zoom = $params['zoom'];
	}

	$scale = 1;
	if (isset($params['scale'])) {
		$scale = $params['scale'];
	}

	$linkParams['center'] = $coordinates->getLatitude() . ',' . $coordinates->getLongitude();
	$linkParams['size'] = $width . 'x' . $height;
	$linkParams['zoom'] = $zoom;
	$linkParams['scale'] = $scale;
	$linkParams['markers'] = 'color:0x99cc6b|' . $coordinates->getLatitude() . ',' . $coordinates->getLongitude();
	$linkParams['sensor'] = 'false';
	$linkParams['key'] = CM_Config::get()->googleApi;

	return CM_Util::link('https://maps.googleapis.com/maps/api/staticmap', $linkParams);
}
