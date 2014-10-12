<?php

class Denkmal_Paging_Message_AllAfterId extends Denkmal_Paging_Message_Abstract {

    /**
     * @param int $startAfterId
     */
    public function __construct($startAfterId) {
        $where = 'id > ' . (int) $startAfterId;
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_message', $where, '`created` DESC');
        parent::__construct($source);
    }
}
