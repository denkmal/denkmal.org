<?php

class Denkmal_Component_SongDetails extends Denkmal_Component_Abstract {

	public function prepare() {
		$label = $this->getParams()->getString('label');

		$this->setTplParam('label', $label);
	}
}
