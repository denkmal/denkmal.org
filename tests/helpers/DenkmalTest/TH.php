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
     * @return Denkmal_Model_Region
     */
    public static function createRegion() {
        return Denkmal_Model_Region::create('New York', 'NY' , 'JFK', self::createLocationCity());
    }
}
