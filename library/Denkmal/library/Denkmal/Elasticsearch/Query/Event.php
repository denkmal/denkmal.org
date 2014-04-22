<?php

class Denkmal_Elasticsearch_Query_Event extends CM_Elasticsearch_Query {

    /**
     * @param bool|null $state
     */
    public function filterEnabled($state = null) {
        if (null === $state) {
            $state = true;
        }
        $this->filterTerm('enabled', (bool) $state);
    }

    /**
     * @param string $terms
     */
    public function queryText($terms) {
        $this->queryMatch(array('description', 'title'), $terms, 'and');
    }

    /**
     * @param string|null $order
     */
    public function sortFrom($order = null) {
        $this->_sort(array('from' => $order));
    }

}
