<?php

class Denkmal_Paging_UserInvite_Expired extends Denkmal_Paging_UserInvite_Abstract {

    /**
     * @param DateTime|null $now
     */
    public function __construct(DateTime $now = null) {
        if (null === $now) {
            $now = new DateTime();
        }
        $where = '`expires` IS NOT NULL AND `expires` < ' . $now->getTimestamp();
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_userinvite', $where, '`id` DESC');
        parent::__construct($source);
    }
}
