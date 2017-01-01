<?php

class Denkmal_Component_EventDetails extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->getVenue('venue');

        $mapLink = null;
        if ($venue->getCoordinates() && !$venue->getSecret()) {
            $mapLink = CM_Util::link('https://www.google.com/maps', [
                'll' => $venue->getCoordinates()->getLatitude() . ',' . $venue->getCoordinates()->getLongitude(),
                'q'  => $venue->getName(),
            ]);
        }

        $viewResponse->set('messageList', new Denkmal_Paging_Message_Venue($venue));
        $viewResponse->set('venue', $venue);
        $viewResponse->set('mapLink', $mapLink);

        $this->_params = CM_Params::factory(); // Empty params to not send them to client
    }
}
