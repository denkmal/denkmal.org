<?php

class Denkmal_Component_SongPlayerButton extends Denkmal_Component_Abstract {

    public function prepare() {
        $song = $this->_params->getSong('song');
        $autoPlay = $this->_params->getBoolean('autoPlay', false);

        $this->_setJsParam('song', $song);
        $this->_setJsParam('autoPlay', $autoPlay);
    }
}
