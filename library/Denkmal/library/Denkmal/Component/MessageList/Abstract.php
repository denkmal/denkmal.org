<?php

abstract class Denkmal_Component_MessageList_Abstract extends Denkmal_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $messageList = $this->_params->getPaging('messageList');
        $messageList->setPage(1, $this->_params->getInt('count', 100));

        $viewer = $environment->getViewer();
        $canDelete = $viewer && $viewer->getRoles()->contains(Denkmal_Role::ADMIN);

        $viewResponse->set('messageList', $messageList);
        $viewResponse->set('canDelete', $canDelete);
        $viewResponse->getJs()->setProperty('canDelete', $canDelete);
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
