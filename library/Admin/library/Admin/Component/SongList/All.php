<?php

class Admin_Component_SongList_All extends Admin_Component_SongList_Abstract {

	public function prepare() {
		$songList = new Denkmal_Paging_Song_All();
		$songList->setPage($this->_params->getPage(), $this->_params->getInt('count', 30));

		$this->setTplParam('songList', $songList);
	}
}
