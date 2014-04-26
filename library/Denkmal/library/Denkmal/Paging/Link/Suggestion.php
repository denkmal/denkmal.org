<?php

class Denkmal_Paging_Link_Suggestion extends Denkmal_Paging_Link_Abstract {

    /**
     * @param Denkmal_Model_Event $event
     */
    public function __construct(Denkmal_Model_Event $event) {
        $text = $event->getDescription();

        $linkIdList = array();

        foreach (Denkmal_Usertext_Filter_Links::getSearchesForManualSuggestions() as $search) {
            if (false === stripos($text, $search['label'])) {
                continue;
            }
            if (preg_match($search['search'], $text)) {
                $linkIdList[] = $search['id'];
            }
        }

        $source = new CM_PagingSource_Array($linkIdList);
        $source->enableCacheLocal(10);
        parent::__construct($source);
    }
}
