<?php

class Denkmal_SearchQuery_Song extends CM_SearchQuery_Abstract {

    /**
     * @param string $terms
     */
    public function queryText($terms) {
        $this->queryMatch(array('label'), $terms);
    }

    public function sortLabel() {
        $this->_sort(array('label' => 'asc'));
    }

}
