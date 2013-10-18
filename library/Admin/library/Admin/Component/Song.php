<?php

class Admin_Component_Song extends Admin_Component_Abstract {

	public function prepare() {
		$song = $this->_params->getSong('song');

		$this->setTplParam('song', $song);
	}
}
