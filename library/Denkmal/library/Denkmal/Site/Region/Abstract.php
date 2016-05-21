<?php

abstract class Denkmal_Site_Region_Abstract extends Denkmal_Site_Default {

    public function __construct() {
        parent::__construct();
        $this->_addTheme('region-' . $this->getRegion()->getSlug());
    }

    public function match(CM_Http_Request_Abstract $request, array $data) {
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
     * @return Denkmal_Model_Region
     */
    abstract public function getRegion();

}
