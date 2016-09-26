<?php

class Denkmal_Paging_FacebookPage_All extends Denkmal_Paging_FacebookPage_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_facebookpage', null, 'LOWER(`name`)');
        parent::__construct($source);
    }

}
