<?php

class Admin_Page_Translations extends CM_Page_Abstract {

    public function prepareResponse(CM_Frontend_Environment $environment, CM_Http_Response_Page $response) {
        $language = ($this->_params->has('language')) ? $this->_params->getLanguage('language') : CM_Model_Language::findDefault();
        if (!$language) {
            $response->redirect('Admin_Page_Translations');
            return;
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $language = ($this->_params->has('language')) ? $this->_params->getLanguage('language') : CM_Model_Language::findDefault();

        $translated = $this->_params->has('translated') ? $this->_params->getBoolean('translated') : null;
        $viewResponse->set('translated', $translated);
        $viewResponse->set('language', $language);
    }
}
