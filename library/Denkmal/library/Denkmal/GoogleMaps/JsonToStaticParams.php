<?php

class Denkmal_GoogleMaps_JsonToStaticParams {

    /**
     * @param string $json
     * @return array
     */
    public static function create($json) {
        $jsonArray = json_decode($json, true);
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
    private static function _handleStylerValue($value) {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (preg_match('/^#[0-9a-f]{6}$/i', (string) $value)) {
            return '0x' . substr($value, 1);
        }
        return $value;
    }
}
