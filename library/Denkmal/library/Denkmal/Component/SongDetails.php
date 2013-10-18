<?php

class Denkmal_Component_SongDetails extends Denkmal_Component_Abstract {

	public function prepare() {
		/** @var Denkmal_Params $params */
		$params = $this->getParams();
		$song = $params->getSong('song');

		$this->setTplParam('song', $song);
	}
}
