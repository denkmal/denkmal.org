<?php

class Admin_FormAction_FacebookPageList_Add extends Admin_FormAction_Abstract {

    protected function _process(CM_Params $params, CM_Http_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        /** @var Denkmal_Params $formParams */
        $formParams = $form->getParams();
        $region = $formParams->getRegion('region');
        $facebookPage = $params->getFacebookPage('facebookPage');

        $list = new Denkmal_Paging_FacebookPage_ListScraper($region);
        $list->add($facebookPage);

        $response->reloadComponent();
    }
}
