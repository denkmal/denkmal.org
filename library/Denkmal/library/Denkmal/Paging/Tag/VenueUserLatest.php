<?php

class Denkmal_Paging_Tag_VenueUserLatest extends Denkmal_Paging_Tag_Abstract {

    /**
     * @param Denkmal_Model_Venue $venue
     * @param DateTime|null       $createdMin
     */
    public function __construct(Denkmal_Model_Venue $venue, DateTime $createdMin = null) {
        if ($createdMin == null) {
            $createdMin = (new DateTime())->sub(new DateInterval('PT1H'));
        }

        $join = 'JOIN `denkmal_model_message` m ON `m`.`id` = `denkmal_model_tag_model`.`modelId` ';
        $join .= 'AND `denkmal_model_tag_model`.`modelType` = ' . Denkmal_Model_Message::getTypeStatic();

        $group = '`denkmal_model_tag_model`.`tagId`';

        $where = '`m`.`venue` = ' . $venue->getId();
        $where .= ' AND `m`.`created` > ' . $createdMin->getTimestamp();

        $order = '`m`.`created` DESC, `denkmal_model_tag_model`.tagId ASC';
        $source = new CM_PagingSource_Sql('`denkmal_model_tag_model`.tagId', 'denkmal_model_tag_model', $where, $order, $join, $group);
        $source->enableCacheLocal(100);

        parent::__construct($source);
    }
}
