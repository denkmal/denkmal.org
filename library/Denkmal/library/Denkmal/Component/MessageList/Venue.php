<?php

class Denkmal_Component_MessageList_Venue extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->getVenue('venue');
        $messageList = new Denkmal_Paging_Message_Venue($venue);
        $messageList->setPage(1, $this->_params->getInt('count', 3));

        $this->_params->set('messageList', $messageList);

        parent::prepare($environment, $viewResponse);
    }
}
