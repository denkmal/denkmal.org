<?php

class Denkmal_GoogleMaps_StaticMapsParams {

    /**
     * @param CM_Geo_Point $coordinates
     * @param mixed        $params
     * @return array
     */
    public function getParams($coordinates, $params) {
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

        $linkParams['key'] = CM_Config::get()->googleApi;
        $linkParams['zoom'] = $zoom;
        $linkParams['format'] = 'jpg';
        $linkParams['size'] = $width . 'x' . $height;
        $linkParams['markers'] = 'color:0xD60725|' . $coordinates->getLatitude() . ',' . $coordinates->getLongitude();

        $stylesParams = '';
        if (isset($params['jsonStyles'])) {
            $styles = self::_jsonStyles($params['jsonStyles']);
            foreach ($styles as $style) {
                $stylesParams .= '&style=' . urlencode($style);
            }
        }

        return CM_Util::link('https://maps.googleapis.com/maps/api/staticmap', $linkParams) . $stylesParams;
    }

    /**
     * @param string $json
     * @return array
     */
    protected function _jsonStyles($json) {
        $jsonArray = CM_Util::jsonDecode($json);
        $items = [];
        $separator = '|';

        foreach ($jsonArray as $item) {
            $hasFeature = array_key_exists('featureType', $item);
            $hasElement = array_key_exists('elementType', $item);
            $hasStylers = array_key_exists('stylers', $item);
            $target = '';
            $style = '';

            if (!$hasFeature && !$hasElement) {
                $target = 'feature:all';
            } else {
                if ($hasFeature) {
                    $target = 'feature:' . $item['featureType'];
                }
                if ($hasElement) {
                    $target = $target ? $target . $separator : '';
                    $target .= 'element:' . $item['elementType'];
                }
            }

            if ($hasStylers) {
                $stylers = $item['stylers'];

                foreach ($stylers as $styleItem) {
                    $key = key($styleItem);
                    $style = $style ? $style . $separator : '';
                    $style .= $key . ':' . self::_handleStylerValue($styleItem[$key]);
                }
            }

            $items[] = $target . $separator . $style;
        }
        return $items;
    }

    /**
     * @param mixed $value
     * @return string
     */
    protected function _handleStylerValue($value) {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (preg_match('/^#[0-9a-f]{6}$/i', (string) $value)) {
            return '0x' . substr($value, 1);
        }
        return $value;
    }
}
