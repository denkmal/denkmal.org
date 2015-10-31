<?php

class Denkmal_Paging_Event_SearchText extends Denkmal_Paging_Event_Abstract {

    /**
     * @param string $text
     */
    public function __construct($text) {
        $query = new Denkmal_Elasticsearch_Query_Event();

        $query->queryText($text);
        $query->sortFrom();

        $client = CM_Service_Manager::getInstance()->getElasticsearch()->getClient();
        $source = new CM_PagingSource_Elasticsearch(new Denkmal_Elasticsearch_Type_Event($client), $query);
        parent::__construct($source);
    }
}
