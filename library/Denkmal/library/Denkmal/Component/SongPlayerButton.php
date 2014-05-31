<?php

class Denkmal_Component_SongPlayerButton extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $song = $this->_params->getSong('song');
        $autoPlay = $this->_params->getBoolean('autoPlay', false);

        $viewResponse->getJs()->setProperty('song', $song);
        $viewResponse->getJs()->setProperty('autoPlay', $autoPlay);
    }
}
