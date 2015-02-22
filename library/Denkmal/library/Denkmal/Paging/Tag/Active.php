<?php

class Denkmal_Paging_Tag_Active extends Denkmal_Paging_Tag_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_tag', 'active=1', 'label');
        $source->enableCache();
        parent::__construct($source);
    }
}
