<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

    public function prepare() {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

        $isPersistent = ($event->hasIdRaw() && $venue->hasIdRaw());

        $this->setTplParam('event', $event);
        $this->setTplParam('venue', $venue);
        $this->setTplParam('allowDetails', $isPersistent);

        if ($isPersistent) {
            $this->_setJsParam('event', $event);
            $this->_setJsParam('venue', $venue);
        } else {
            $this->_params = CM_Params::factory(); // Empty params to not send them to client
        }
    }
}
