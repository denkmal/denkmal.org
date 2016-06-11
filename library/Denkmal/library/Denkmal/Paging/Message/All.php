<?php

class Denkmal_Paging_Message_All extends Denkmal_Paging_Message_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_message', null, '`created` DESC');
        $source->enableCache();
        parent::__construct($source);
    }
}
