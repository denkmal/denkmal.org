<?php

abstract class Denkmal_Site_Region_Abstract extends Denkmal_Site_Default {

    public function match(CM_Http_Request_Abstract $request) {
        if (!$this->hasRegion()) {
            return false;   // When the region has not been created (e.g. in tests)
        }

        $match = parent::match($request);
        if ($match) {
            $match = $this->isEnabled();
        }
        return $match;
    }

    /**
     * @return bool
     */
    public function isEnabled() {
        return true;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return parent::getUrl() . '/' . $this->getRegion()->getSlug();
    }

    /**
     * @return string[]
     */
    public function getThemes() {
        $themes = parent::getThemes();
        $regionTheme = 'region-' . $this->getRegion()->getSlug();
        return array_merge([$regionTheme], $themes);
    }

    /**
     * @return bool
     */
    public function hasRegion() {
        return null !== Denkmal_Model_Region::findBySlug($this->_getRegionSlug());
    }

    /**
     * @return Denkmal_Model_Region
     * @throws CM_Exception
     */
    public function getRegion() {
        $slug = $this->_getRegionSlug();
        return Denkmal_Model_Region::getBySlug($slug);
    }

    /**
     * @return Denkmal_Site_Region_Abstract[]
     */
    public static function getAllSites() {
        $siteClassList = self::getClassChildren();
        $siteList = Functional\map($siteClassList, function ($className) {
            return new $className();
        });
        $siteList = Functional\filter($siteList, function (Denkmal_Site_Region_Abstract $site) {
            return $site->isEnabled();
        });
        return $siteList;
    }

    /**
     * @param CM_Model_Location $location
     * @return Denkmal_Site_Region_Abstract|null
     */
    public static function findSiteByLocation(CM_Model_Location $location) {
        $geoPoint = $location->getGeoPoint();
        if ($geoPoint && $site = self::findSiteByGeoPoint($geoPoint)) {
            return $site;
        }
        return self::findSiteByCountry($location);
    }

    /**
     * @param CM_Geo_Point $point
     * @return Denkmal_Site_Region_Abstract|null
     * @throws CM_Exception
     */
    public static function findSiteByGeoPoint(CM_Geo_Point $point) {
        $distanceMax = 1000 * 100;

        $resultSite = null;
        $resultDistance = null;
        foreach (self::getAllSites() as $site) {
            $region = $site->getRegion();
            $pointSite = $region->getLocation()->getGeoPoint();
            if (null === $pointSite) {
                throw new CM_Exception('Region location is missing GeoPoint', null, ['region' => $region]);
            }
            $distance = $pointSite->calculateDistanceTo($point);
            if ($distance < $distanceMax && (null === $resultDistance || $distance < $resultDistance)) {
                $resultSite = $site;
                $resultDistance = $distance;
            }
        }
        return $resultSite;
    }

    /**
     * @param CM_Model_Location $location
     * @return Denkmal_Site_Region_Abstract|null
     */
    public static function findSiteByCountry(CM_Model_Location $location) {
        $siteList = self::getAllSites();

        return Functional\first($siteList, function (Denkmal_Site_Region_Abstract $site) use ($location) {
            $locationSite = $site->getRegion()->getLocation();
            return $location->getId(CM_Model_Location::LEVEL_COUNTRY) === $locationSite->getId(CM_Model_Location::LEVEL_COUNTRY);
        });
    }

    /**
     * @param Denkmal_Model_Region $region
     * @return Denkmal_Site_Region_Abstract|null
     */
    public static function findSiteByRegion(Denkmal_Model_Region $region) {
        $site = Functional\first(self::getAllSites(), function (Denkmal_Site_Region_Abstract $site) use ($region) {
            return $site->getRegion()->equals($region);
        });
        return $site;
    }

    /**
     * @return string
     */
    abstract protected function _getRegionSlug();

}
