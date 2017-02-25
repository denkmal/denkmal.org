<?php

abstract class Denkmal_Page_Abstract extends CM_Page_Abstract {

    /** @var Denkmal_Params */
    protected $_params;

    /** @var Denkmal_Paging_Venue_Abstract */
    protected $_venueBookmarks;

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        /** @var Denkmal_Site_Default $site */
        $site = $response->getSite();

        if ($site->hasRegion()) {
            $suspension = $site->getRegion()->getSuspension();
            if ($suspension->isActive()) {
                if (!$this instanceof Denkmal_Page_Suspended) {
                    $response->redirect('Denkmal_Page_Suspended');
                    return;
                }
            } else {
                if ($this instanceof Denkmal_Page_Suspended) {
                    $response->redirect('Denkmal_Page_Index');
                    return;
                }
            }
        }

        if ($this->_requiresRegion() && !$site->hasRegion()) {
            $url = $response->getRender()->getUrlPage('Denkmal_Page_Index', null, new Denkmal_Site_Default());
            $response->redirectUrl($url);
            return;
        }

        $cookieVenueBookmarks = $response->getRequest()->getCookie('venue-bookmarks');
        $this->_venueBookmarks = new Denkmal_Paging_Venue_Bookmarks($cookieVenueBookmarks);
    }

    /**
     * @return bool
     */
    protected function _requiresRegion() {
        return false;
    }

    /**
     * @return Denkmal_Paging_Venue_Abstract
     */
    protected function _getVenueBookmarks() {
        if (null === $this->_venueBookmarks) {
            $this->_venueBookmarks = new Denkmal_Paging_Venue_Bookmarks(null);
        }
        return $this->_venueBookmarks;
    }
}
