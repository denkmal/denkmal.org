<?php

abstract class Denkmal_Site_Region_Abstract extends Denkmal_Site_Default {

    public function match(CM_Http_Request_Abstract $request) {
        $match = parent::match($request);
        if ($match) {
            // todo: check against site's region
        }
        return $match;
    }

}
