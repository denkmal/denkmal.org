<?php

class Denkmal_Paging_Event_VenueFuture extends Denkmal_Paging_Event_Abstract {

    /**
     * @param Denkmal_Model_Venue $venue
     * @param bool|null           $showAll
     */
    public function __construct(Denkmal_Model_Venue $venue, $showAll = null) {
        $settings = new Denkmal_App_Settings();
        $now = $settings->getCurrentDate();
        $fromStampMin = $now->getTimestamp();

        $where = '`venue` = ' . $venue->getId();
        $where .= ' AND `from` >= ' . $fromStampMin;

        if (!$showAll) {
            $where .= ' AND `enabled` = 1 AND `hidden` = 0';
        }

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, '`from`');
        parent::__construct($source);
    }
}
