<?php

/**
 * See https://developers.google.com/maps/documentation/staticmaps/
 */
class Denkmal_GoogleMaps_StaticMaps {

    /** @var string */
    private $_apikey;

    /**
     * @param string $apiKey
     */
    public function __construct($apiKey) {
        $this->_apikey = $apiKey;
    }

    /**
     * @param CM_Geo_Point $coordinates
     * @param int          $width
     * @param int          $height
     * @param int          $zoom
     * @param array|null   $styles
     * @return string
     */
    public function getUrl(CM_Geo_Point $coordinates, $width, $height, $zoom, array $styles = null) {
        $linkParams['key'] = $this->_apikey;
        $linkParams['zoom'] = $zoom;
        $linkParams['format'] = 'jpg';
        $linkParams['size'] = $width . 'x' . $height;
        $linkParams['markers'] = 'color:0xD60725|' . $coordinates->getLatitude() . ',' . $coordinates->getLongitude();

        $stylesParams = '';
        if ($styles) {
            $styles = self::_convertStyles($styles);
            foreach ($styles as $style) {
                $stylesParams .= '&style=' . urlencode($style);
            }
        }

        return CM_Util::link('https://maps.googleapis.com/maps/api/staticmap', $linkParams) . $stylesParams;
    }

    /**
     * @see https://developers.google.com/maps/documentation/static-maps/styling
     *
     * @param array $styles
     * @return array
     */
    protected function _convertStyles(array $styles) {
        $items = [];
        $separator = '|';

        foreach ($styles as $item) {
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
