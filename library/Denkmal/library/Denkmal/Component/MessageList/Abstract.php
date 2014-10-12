<?php

abstract class Denkmal_Component_MessageList_Abstract extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $messageList = $this->_params->getPaging('messageList');
        $messageList->setPage(1, 100);

        $viewResponse->set('messageList', $messageList);
    }
}
