<?php

class Denkmal_Component_MessageList_All extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $messageList = new Denkmal_Paging_Message_All();

        $this->_params->set('messageList', $messageList);

        parent::prepare($environment, $viewResponse);
    }
}
