<?php

class Admin_FormAction_Song_Save extends Admin_FormAction_Abstract {

    protected function _checkData(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);

        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $song = $formParams->getSong('song');

        $label = $params->getString('label');
        $songSameName = Denkmal_Model_Song::findByLabel($label);
        if ($songSameName && !$songSameName->equals($song)) {
            $response->addError($response->getRender()->getTranslation('Name already in use.'), 'label');
        }
    }

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $song = $formParams->getSong('song');

        $song->setLabel($params->getString('label'));

        $response->reloadComponent();
    }
}
