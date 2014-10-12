<?php

class Denkmal_FormAction_Message_Create extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venue', 'text');
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $venue = $params->getVenue('venue');
        $text = $params->getString('text');
        $clientId = (string) $response->getRequest()->getIp();

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::CREATE, $response->getRequest()->getIp());
        $action->prepare();
        $message = Denkmal_Model_Message::create($venue, $clientId, $text);
        $action->notify($message);

        return $message;
    }
}
