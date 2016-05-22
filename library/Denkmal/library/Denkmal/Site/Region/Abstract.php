<?php

abstract class Denkmal_Site_Region_Abstract extends Denkmal_Site_Default {

    public function match(CM_Http_Request_Abstract $request, array $data) {
        if (!$this->_hasRegion()) {
            return false;   // When the region has not been created (e.g. in tests)
        }

        $match = parent::match($request, $data);
        if ($match) {
            $match = isset($data['region']) && $this->getRegion()->equals($data['region']);
        }
        return $match;
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
     * @return Denkmal_Model_Region
     * @throws CM_Exception
     */
    public function getRegion() {
        $slug = $this->_getRegionSlug();
        $region = Denkmal_Model_Region::findBySlug($slug);
        if (null === $region) {
            throw new CM_Exception('Cannot find region with slug `' . $slug . '`');
        }
        return $region;
    }

    /**
     * @return bool
     */
    protected function _hasRegion() {
        return null !== Denkmal_Model_Region::findBySlug($this->_getRegionSlug());
    }

    abstract protected function _getRegionSlug();

}
