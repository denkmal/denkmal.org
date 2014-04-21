<?php

class Denkmal_Paging_Song_Suggestion extends Denkmal_Paging_Song_Abstract {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $textList = array($event->getDescription(), $event->getTitle());
        $textList = array_filter($textList);
        $text = implode(' ', $textList);

        $termList = array();

        foreach (Denkmal_Usertext_Filter_Links::getReplacements() as $replacement) {
            if (false === stripos($text, $replacement['label'])) {
                continue;
            }
            if (preg_match($replacement['search'], $text)) {
                $termList[] = $replacement['label'];
            }
        }

        $query = new Denkmal_Elasticsearch_Query_Song();
        $query->queryText(implode(' ', $termList));

        $source = new CM_PagingSource_Search(new Denkmal_Elasticsearch_Type_Song(), $query);
        $source->enableCacheLocal(10);
        parent::__construct($source);
    }
}
