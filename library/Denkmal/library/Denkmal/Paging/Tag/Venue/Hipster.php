<?php

class Denkmal_Paging_Tag_Venue_Hipster extends Denkmal_Paging_Tag_Abstract {

    /**
     * @param Denkmal_Model_Venue $venue
     */
    public function __construct(Denkmal_Model_Venue $venue) {
        $where = '`denkmal_model_tag_model`.`modelType` = ' . Denkmal_Model_Message::getTypeStatic() . ' and `m`.`venue` = ' . $venue->getId();
        $join = 'JOIN `denkmal_model_message` m ON `m`.`id` = `denkmal_model_tag_model`.modelId';

        $source = new CM_PagingSource_Sql('`denkmal_model_tag_model`.tagId', 'denkmal_model_tag_model', $where, '`m`.`created` DESC', $join);
        $source->enableCache();
        parent::__construct($source);
    }
}
