<?php

class Denkmal_Paging_User_All extends Denkmal_Paging_User_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('userId', 'denkmal_model_user', null, 'username');

        parent::__construct($source);
    }
}
