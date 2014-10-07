<?php

class Denkmal_Paging_Venue_Search extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param string $term
     */
    public function __construct($term) {
        $term = (string) $term;
        $join = 'LEFT JOIN denkmal_model_venuealias ON(denkmal_model_venuealias.venue = denkmal_model_venue.id)';
        $where = 'LOWER(denkmal_model_venue.name) LIKE ? OR LOWER(denkmal_model_venuealias.name) LIKE ?';
        $order = 'denkmal_model_venue.name ASC';
        $source = new CM_PagingSource_Sql('DISTINCT denkmal_model_venue.id', 'denkmal_model_venue', $where, $order, $join, null,
            array('%' . strtolower($term) . '%', '%' . strtolower($term) . '%'));
        parent::__construct($source);
    }
}
