<?php

abstract class Denkmal_Component_MessageList_Abstract extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $messageList = $this->_params->getPaging('messageList');

        $viewResponse->set('messageList', $messageList);
    }

    public function ajax_deleteMessage(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $viewer = $response->getViewer(true);
        $message = $params->getMessage('message');

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::DELETE, $viewer);
        $action->prepare($message);
        $message->delete();
        $action->notify($message);

        $response->reloadComponent();
    }
}
