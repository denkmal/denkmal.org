<?php

abstract class Denkmal_Site_Region_Abstract extends Denkmal_Site_Default {

    public function match(CM_Http_Request_Abstract $request, array $data) {
        if (!$this->hasRegion()) {
            return false;   // When the region has not been created (e.g. in tests)
        }

        $match = parent::match($request, $data);
        if ($match) {
            $match = isset($data['region']) && $this->getRegion()->equals($data['region']);
        }
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
     * @return string
     */
    abstract protected function _getRegionSlug();

}
