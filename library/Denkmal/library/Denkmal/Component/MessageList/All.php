<?php

class Denkmal_Component_MessageList_All extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $this->_params->set('messageList', new Denkmal_Paging_Message_All());

        parent::prepare($environment, $viewResponse);
    }
}
