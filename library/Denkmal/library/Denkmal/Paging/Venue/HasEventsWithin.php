<?php

class Denkmal_Paging_Venue_HasEventsWithin extends Denkmal_Paging_Venue_Abstract {

    /**
     * @param DateTime $dateStart
     * @param DateTime $dateEnd
     */
    public function __construct(DateTime $dateStart, DateTime $dateEnd) {
        $settings = new Denkmal_App_Settings();
        $dateStart->setTime($settings->getDayOffset(), 0, 0);
        $startStamp = $dateStart->getTimestamp();

        $dateEnd->setTime($settings->getDayOffset(), 0, 0);
        $dateEnd->add(new DateInterval('P1D'));
        $endStamp = $dateEnd->getTimestamp();

        $join = 'JOIN denkmal_model_event ON denkmal_model_event.venue = denkmal_model_venue.id';
        $where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp;

        $source = new CM_PagingSource_Sql('DISTINCT(denkmal_model_venue.id)', 'denkmal_model_venue', $where, null, $join);
        parent::__construct($source);
    }
}
