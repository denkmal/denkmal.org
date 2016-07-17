<?php

class Denkmal_Paging_Region_All extends Denkmal_Paging_Region_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_region', null, '`slug` ASC');
        $source->enableCache();
        parent::__construct($source);
    }
}
