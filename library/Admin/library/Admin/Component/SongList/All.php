<?php

class Admin_Component_SongList_All extends Admin_Component_SongList_Abstract {

	public function prepare() {
		$songList = new Denkmal_Paging_Song_All();

		$this->setTplParam('songList', $songList);
	}
}
