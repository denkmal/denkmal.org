<?php

class Denkmal_Component_MessageList_Site extends Denkmal_Component_MessageList_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $messageList = $site->getRegion()->getMessageList();

        $this->_params->set('messageList', $messageList);

        parent::prepare($environment, $viewResponse);
    }
}
