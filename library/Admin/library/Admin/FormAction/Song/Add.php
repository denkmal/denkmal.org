<?php

class Admin_FormAction_Song_Add extends Admin_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);

        if (!$params->has('files')) {
            $response->addError('File required', 'files');
        }

        $label = $params->getString('label');
        if (Denkmal_Model_Song::findByLabel($label)) {
            $response->addError($response->getRender()->getTranslation('Name already in use.'), 'label');
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        $label = $params->getString('label');
        $fileTmpList = $params->getArray('files');
        /** @var CM_File_UserContent_Temp $fileTmp */
        $fileTmp = $fileTmpList[0];

        Denkmal_Model_Song::create($label, $fileTmp);
        $fileTmp->delete();
    }
}
