<?php

class Denkmal_Paging_Link_Search extends Denkmal_Paging_Link_Abstract {

    /**
     * @param string $term
     */
    public function __construct($term) {
        $term = (string) $term;
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_link', 'LOWER(`label`) LIKE ?', 'label asc', null, null, array('%' . strtolower($term) . '%'));
        parent::__construct($source);
    }
}
