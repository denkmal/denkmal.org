<?php

class Denkmal_Paging_Venue_GeoPoint extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param CM_Geo_Point $point
     * @param int          $distanceMax
     */
    public function __construct(CM_Geo_Point $point, $distanceMax) {
        $lat = $point->getLatitude();
        $lon = $point->getLongitude();
        $earthRadius = 6371009;

        $pi180 = M_PI / 180;
        $metersPerDegreeEquator = $earthRadius * $pi180;
        $metersPerDegree = $metersPerDegreeEquator * cos($lat * $pi180);

        $latMin = $lat - $distanceMax / $metersPerDegreeEquator;
        $latMax = $lat + $distanceMax / $metersPerDegreeEquator;
        $lonMin = $lon - $distanceMax / $metersPerDegree;
        $lonMax = $lon + $distanceMax / $metersPerDegree;

        $where = "MBRContains(LineString(Point($latMax, $lonMax), Point($latMin, $lonMin)), Point(`latitude`, `longitude`))";
        $where .= ' AND `suspended` = 0';
        $order = "((POW($lat - `latitude`, 2)) + (POW($lon - `longitude`, 2))) ASC";
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', $where, $order);
        parent::__construct($source);
    }
}
