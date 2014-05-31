<?php

class Admin_Component_SongList_All extends Admin_Component_SongList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $searchTerm = $this->_params->has('searchTerm') ? $this->_params->getString('searchTerm') : null;

        if (null !== $searchTerm) {
            $songList = new Denkmal_Paging_Song_Search($searchTerm);
        } else {
            $songList = new Denkmal_Paging_Song_All();
        }
        $songList->setPage($this->_params->getPage(), $this->_params->getInt('count', 30));

        $viewResponse->set('songList', $songList);
        $viewResponse->set('searchTerm', $searchTerm);
    }
}
