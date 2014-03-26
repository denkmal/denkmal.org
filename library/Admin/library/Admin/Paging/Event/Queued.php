<?php

class Admin_Paging_Event_Queued extends Denkmal_Paging_Event_Abstract {

    public function __construct() {
        $where = '`queued` = 1 AND `hidden` = 0';

        $source = new CM_PagingSource_Sql('id', 'denkmal_model_event', $where, '`from`');
        parent::__construct($source);
    }
}
