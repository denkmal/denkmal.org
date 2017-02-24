<?php

class Denkmal_Paging_EventCategory_All extends Denkmal_Paging_EventCategory_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_eventcategory', null, 'label asc');
        $source->enableCache();
        parent::__construct($source);
    }
}
