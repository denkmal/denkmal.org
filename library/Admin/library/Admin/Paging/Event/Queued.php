<?php

class Admin_Paging_Event_Queued extends Denkmal_Paging_Event_Abstract {

    /**
     * @param Denkmal_Model_Region $region
     */
    public function __construct(Denkmal_Model_Region $region) {
        $settings = new Denkmal_App_Settings();
        $today = $settings->getCurrentDate();
        $today->setTime($settings->getDayOffset(), 0, 0);

        $where = 'event.queued = 1 AND event.hidden = 0 AND event.from >= ' . $today->getTimestamp();
        $where .= ' AND venue.region = ' . $region->getId();

        $join = 'JOIN `denkmal_model_venue` AS venue ON event.venue = venue.id';

        $source = new CM_PagingSource_Sql('event.id', 'denkmal_model_event` AS `event', $where, 'event.from', $join);
        parent::__construct($source);
    }
}
