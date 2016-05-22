<?php

class Admin_Paging_Event_Queued extends Denkmal_Paging_Event_Abstract {

    public function __construct() {
        $settings = new Denkmal_App_Settings();
        $today = $settings->getCurrentDate();
        $today->setTime($settings->getDayOffset(), 0, 0);

        $where = '`queued` = 1 AND `hidden` = 0 AND `from` >= ' . $today->getTimestamp();

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, '`from`');
        parent::__construct($source);
    }
}
