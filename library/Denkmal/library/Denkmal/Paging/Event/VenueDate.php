<?php

class Denkmal_Paging_Event_VenueDate extends Denkmal_Paging_Event_Abstract {

    /**
     * @param DateTime            $date
     * @param Denkmal_Model_Venue $venue
     */
    public function __construct(DateTime $date, Denkmal_Model_Venue $venue) {
        $date = clone $date;
        $date->setTime(0, 0);
        $startStamp = $date->getTimestamp();
        $date->add(new DateInterval('P1D'));
        $endStamp = $date->getTimestamp();
        $where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp . ' AND `venue` = ' . $venue->getId();

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where);
        parent::__construct($source);
    }
}
