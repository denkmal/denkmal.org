<?php

class Denkmal_FormAction_Message_Create extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venue');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        if (0 === count($params->get('tags')) && !$params->has('text')) {
            $response->addError($response->getRender()->getTranslation('Bitte Nachricht eingeben'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $venue = $params->getVenue('venue');
        $text = $params->has('text') ? $params->getString('text') : null;
        $viewer = $response->getViewer();
        $clientId = (string) $response->getRequest()->getClientId();

        $image = null;
        if ($params->has('image')) {
            /** @var CM_File_UserContent_Temp $file */
            $file = $params->getArray('image')[0];
            $image = Denkmal_Model_MessageImage::create(new CM_File_Image($file));
        }

        /** @var Denkmal_Model_Tag[] $tagList */
        $tagList = $params->get('tags');

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::CREATE, $response->getRequest()->getIp());
        $action->prepare();
        $message = Denkmal_Model_Message::create($venue, $clientId, $viewer, $text, $image);
        foreach($tagList as $tag) {
            $message->getTags()->add($tag);
        }
        $action->notify($message);

        return $message;
    }
}
