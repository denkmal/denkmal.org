<?php

class Denkmal_Paging_Venue_Search extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param string                    $term
     * @param Denkmal_Model_Region|null $region
     */
    public function __construct($term, Denkmal_Model_Region $region = null) {
        $term = (string) $term;
        $join = 'LEFT JOIN denkmal_model_venuealias ON(denkmal_model_venuealias.venue = denkmal_model_venue.id)';
        $where = '(LOWER(denkmal_model_venue.name) LIKE ? OR LOWER(denkmal_model_venuealias.name) LIKE ?)';
        if ($region) {
            $where .= ' AND denkmal_model_venue.region = ' . $region->getId();
        }
        $order = 'denkmal_model_venue.name ASC';
        $source = new CM_PagingSource_Sql('DISTINCT denkmal_model_venue.id', 'denkmal_model_venue', $where, $order, $join, null,
            array('%' . strtolower($term) . '%', '%' . strtolower($term) . '%'));
        parent::__construct($source);
    }
}
