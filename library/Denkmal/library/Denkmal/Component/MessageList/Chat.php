<?php

class Denkmal_Component_MessageList_Chat extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : null;

        if ($venue) {
            $messageList = new Denkmal_Paging_Message_Venue($venue);
        } else {
            $messageList = new Denkmal_Paging_Message_All();
        }

        $this->_params->set('messageList', $messageList);

        parent::prepare($environment, $viewResponse);
    }
}
