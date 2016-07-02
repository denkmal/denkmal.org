<?php

class DenkmalTest_TH extends CMTest_TH {

    /**
     * @return CM_Model_Location
     */
    public static function createLocationCountry() {
        return CM_Model_Location::createCountry('United States', 'US');
    }

    /**
     * @return CM_Model_Location
     */
    public static function createLocationState() {
        $country = self::createLocationCountry();
        return CM_Model_Location::createState($country, 'New York');
    }

    /**
     * @return CM_Model_Location
     */
    public static function createLocationCity() {
        $state = self::createLocationState();
        $city = CM_Model_Location::createCity($state, 'New York', 40.7647, -73.979);
        CM_Model_Location::createAggregation();
        return $city;
    }

    /**
     * @param string|null            $name
     * @param string|null            $slug
     * @param string|null            $abbreviation
     * @param CM_Model_Location|null $location
     * @return Denkmal_Model_Region
     */
    public static function createRegion($name = null, $slug = null, $abbreviation = null, CM_Model_Location $location = null) {
        if (null === $name) {
            $name = self::randStr(6);
        }
        if (null === $slug) {
            $slug = self::randStr(6);
        }
        if (null === $abbreviation) {
            $abbreviation = self::randStr(3);
        }
        if (null === $location) {
            $location = self::createLocationCity();
        }
        return Denkmal_Model_Region::create((string) $name, (string) $slug, (string) $abbreviation, $location);
    }

    /**
     * @param string|null               $name
     * @param boolean|null              $queued
     * @param boolean|null              $ignore
     * @param Denkmal_Model_Region|null $region
     * @param string|null               $url
     * @param string|null               $address
     * @param CM_Geo_Point|null         $coordinates
     * @return Denkmal_Model_Venue
     */
    public static function createVenue($name = null, $queued = null, $ignore = null, Denkmal_Model_Region $region = null, $url = null, $address = null, CM_Geo_Point $coordinates = null) {
        if (null === $name) {
            $name = self::randStr(3) . ' Venue';
        }
        if (null === $queued) {
            $queued = false;
        }
        if (null === $ignore) {
            $ignore = false;
        }
        if (null === $region) {
            $region = self::createRegion();
        }
        if (null === $url) {
            $url = 'http://bar.baz/?foo=quux';
        }
        if (null === $address) {
            $address = '221B Baker Street, London';
        }
        if (null === $coordinates) {
            $coordinates = new CM_Geo_Point(-21.1234, 12.98786);
        }
        return Denkmal_Model_Venue::create((string) $name, (bool) $queued, (bool) $ignore, $region, (string) $url, (string) $address, $coordinates);
    }

    /**
     * @param int    $length
     * @param string $charset
     * @return string
     */
    public static function randStr($length, $charset = 'abcdefghijklmnopqrstuvwxyz0123456789') {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }
}
