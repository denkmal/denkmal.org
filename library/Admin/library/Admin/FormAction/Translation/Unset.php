<?php

class Admin_FormAction_Translation_Unset extends CM_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Model_User $user */
        $user = $response->getViewer(true);

        /** @var Admin_Form_Translation $form */
        if (!$form->canEdit($user)) {
            $response->addError($response->getRender()->getTranslation('Not Allowed'));
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $paramsForm */
        $paramsForm = $form->getParams();

        $language = $paramsForm->getLanguage('language');
        $language->getTranslations()->remove($paramsForm->getString('key'));
    }
}
