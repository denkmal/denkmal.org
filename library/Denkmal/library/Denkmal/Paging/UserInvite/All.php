<?php

class Denkmal_Paging_UserInvite_All extends Denkmal_Paging_UserInvite_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_userinvite', null, '`id` DESC');
        parent::__construct($source);
    }
}
