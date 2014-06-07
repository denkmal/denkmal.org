<?php

class Denkmal_Elasticsearch_Query_Song extends CM_Elasticsearch_Query {

    /**
     * @param string $terms
     */
    public function queryText($terms) {
        $this->queryMatchMulti(array('label'), $terms);
    }

    public function sortLabel() {
        $this->_sort(array('label' => 'asc'));
    }
}
