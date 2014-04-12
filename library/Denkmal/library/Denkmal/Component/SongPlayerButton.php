<?php

class Denkmal_Component_SongPlayerButton extends Denkmal_Component_Abstract {

    public function prepare() {
        $song = $this->_params->getSong('song');

        $this->_setJsParam('song', $song);
    }
}
