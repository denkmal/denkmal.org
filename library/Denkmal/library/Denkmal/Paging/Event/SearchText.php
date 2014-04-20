<?php

class Denkmal_Paging_Event_SearchText extends Denkmal_Paging_Event_Abstract {

    /**
     * @param string $text
     */
    public function __construct($text) {
        $query = new Denkmal_Elasticsearch_Query_Event();

        $query->queryText($text);
        $query->sortScore();

        $source = new CM_PagingSource_Search(new Denkmal_Elasticsearch_Type_Event(), $query);

        parent::__construct($source);
    }
}
