<?php

class Admin_FormAction_EventCategoryGenre_Add extends Admin_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $eventCategory = $formParams->getEventCategory('eventCategory');

        $genre = $params->getString('genre');
        $eventCategory->addGenre($genre);

        $response->reloadComponent();
    }
}
