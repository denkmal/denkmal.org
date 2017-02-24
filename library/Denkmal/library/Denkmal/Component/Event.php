<?php

class Denkmal_Component_Event extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : $event->getVenue();

        $isPersistent = ($event->hasIdRaw() && $venue->hasIdRaw());

        $viewResponse->set('event', $event);
        $viewResponse->set('venue', $venue);

        if (!$isPersistent) {
            $this->_params = CM_Params::factory(); // Empty params to not send them to client
        }
    }
}
