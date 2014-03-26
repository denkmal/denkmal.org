<?php

class Admin_Page_Venue extends Admin_Page_Abstract {

    public function prepare() {
        $venue = $this->_params->getVenue('venue');

        $this->setTplParam('venue', $venue);
    }
}
