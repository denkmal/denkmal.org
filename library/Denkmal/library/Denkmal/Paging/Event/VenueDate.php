<?php

class Denkmal_Paging_Event_VenueDate extends Denkmal_Paging_Event_Abstract {

    /**
     * @param DateTime                   $date
     * @param Denkmal_Model_Venue        $venue
     * @param bool|null                  $showAll
     * @param Denkmal_Model_Event[]|null $excludeEvents
     */
    public function __construct(DateTime $date, Denkmal_Model_Venue $venue, $showAll = null, $excludeEvents = null) {
        $settings = new Denkmal_App_Settings();
        $date = clone $date;
        $date->setTime($settings->getDayOffset(), 0, 0);
        $startStamp = $date->getTimestamp();
        $date->add(new DateInterval('P1D'));
        $endStamp = $date->getTimestamp();
        $where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp . ' AND `venue` = ' . $venue->getId();

        if ($excludeEvents) {
            foreach ($excludeEvents as $event) {
                $where .= ' AND `id` != ' . $event->getId();
            }
        }

        if (!$showAll) {
            $where .= ' AND `enabled` = 1 AND `hidden` = 0';
        }

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where);
        parent::__construct($source);
    }
}
