<?php

class Admin_FormAction_Translation_Save extends CM_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('language', 'key');
    }

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var SK_User $user */
        $user = $response->getViewer(true);

        /** @var Admin_Form_Translation $form */
        if (!$form->canEdit($user)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var SK_Params $paramsForm */
        $paramsForm = $form->getParams();

        $language = $paramsForm->getLanguage('language');
        $language->setTranslation($paramsForm->getString('key'), $params->getString('value', ''));
    }
}
