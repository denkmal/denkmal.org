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

        $image = null;
        $fileList = $params->getArray('image');
        if (count($fileList) > 0) {
            /** @var CM_File_UserContent_Temp $file */
            $file = $fileList[0];
            $image = Denkmal_Model_MessageImage::create(new CM_File_Image($file));
        }

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::CREATE, $response->getRequest()->getIp());
        $action->prepare();
        $message = Denkmal_Model_Message::create($venue, $clientId, $text, $image);
        $action->notify($message);

        return $message;
    }
}
