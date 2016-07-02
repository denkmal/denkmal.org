<?php

class Denkmal_Paging_Event_Date extends Denkmal_Paging_Event_Abstract {

    /**
     * @param Denkmal_Model_Region $region
     * @param DateTime             $date
     * @param bool|null            $showAll
     */
    public function __construct(Denkmal_Model_Region $region, DateTime $date, $showAll = null) {
        $settings = new Denkmal_App_Settings();
        $date = clone $date;
        $date->setTime($settings->getDayOffset(), 0, 0);
        $startStamp = $date->getTimestamp();
        $date->add(new DateInterval('P1D'));
        $endStamp = $date->getTimestamp();
        $where = '`from` >= ' . $startStamp . ' AND `from` < ' . $endStamp;
        $where .= ' AND `v`.`region` = ' . $region->getId();

        if (!$showAll) {
            $where .= ' AND `enabled` = 1 AND `hidden` = 0';
        }

        $join = 'JOIN `denkmal_model_venue` AS `v` ON `e`.`venue` = `v`.`id`';

        $source = new CM_PagingSource_Sql('e.id', 'denkmal_model_event` AS `e', $where, '`starred` DESC, LOWER(`v`.`name`), `e`.`id`', $join);
        parent::__construct($source);
    }
}
