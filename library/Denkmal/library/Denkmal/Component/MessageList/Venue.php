<?php

class Denkmal_Component_MessageList_Venue extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {

        $venue = $this->_params->has('venue') ? $this->_params->getVenue('venue') : null;
        $this->_params->set('messageList', new Denkmal_Paging_Message_Venue($venue));

        parent::prepare($environment, $viewResponse);
    }
}
