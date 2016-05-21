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
            $name = 'New York';
        }
        if (null === $slug) {
            $slug = 'NY';
        }
        if (null === $abbreviation) {
            $abbreviation = 'JFK';
        }
        if (null === $location) {
            $location = self::createLocationCity();
        }
        return Denkmal_Model_Region::create((string) $name, (string) $slug, (string) $abbreviation, $location);
    }
}
