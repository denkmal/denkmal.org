<?php

class Admin_Site extends Denkmal_Site_Default {

    /** @var Denkmal_Model_Region|null */
    private $_region;

    /**
     * @param Denkmal_Model_Region|null $region
     */
    public function __construct(Denkmal_Model_Region $region = null) {
        parent::__construct();

        $this->_setModule('Admin');
        if ($region) {
            $this->_region = $region;
        }
    }

    public function match(CM_Http_Request_Abstract $request) {
        $match = parent::match($request);
        if ($match) {
            $slug = $request->getPathPart(0);
            $region = Denkmal_Model_Region::findBySlug($slug);
            if ($region) {
                $request->popPathPart(0);
                $this->_region = $region;
            }
        }
        return $match;
    }

    public function getMenus() {
        return array(
            'main'     => new Admin_Menu_Main(),
            'weekdays' => new Admin_Menu_Weekdays(),
        );
    }

    /**
     * @return string
     */
    public function getLoginPage() {
        return 'Admin_Page_Events';
    }

    public function hasRegion() {
        return null !== $this->_region;
    }

    public function getRegion() {
        if (null === $this->_region) {
            throw new CM_Exception('No region available on site');
        }
        return $this->_region;
    }

    /**
     * @return string
     */
    public function getUrl() {
        $url = parent::getUrl();
        if ($this->hasRegion()) {
            $url .= '/' . $this->getRegion()->getSlug();
        }
        return $url;
    }

}
