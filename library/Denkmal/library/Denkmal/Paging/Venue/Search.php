<?php

class Denkmal_Paging_Venue_Search extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param string $term
     */
    public function __construct($term) {
        $term = (string) $term;
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_venue', 'LOWER(`name`) LIKE ?', 'name asc', null, null, array('%' . strtolower($term) . '%'));
        parent::__construct($source);
    }
}
