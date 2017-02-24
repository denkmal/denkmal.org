<?php

class Denkmal_Paging_Song_Suggestion extends Denkmal_Paging_Song_Abstract {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $text = $event->getDescription();
        $text = CM_Util::htmlspecialchars($text, ENT_QUOTES);

        $termList = preg_split('#\s+#', $event->getDescription());
        $termList = Functional\reject($termList, function ($term) {
            return mb_strlen($term) < 3;
        });

        $query = new Denkmal_Elasticsearch_Query_Song();
        $query->queryText(implode(' ', $termList));

        $client = CM_Service_Manager::getInstance()->getElasticsearch()->getClient();
        $source = new CM_PagingSource_Elasticsearch(new Denkmal_Elasticsearch_Type_Song($client), $query);
        $source->enableCacheLocal(10);
        parent::__construct($source);
    }
}
