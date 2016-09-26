<?php

class Denkmal_FormField_FacebookPage extends CM_FormField_SuggestOne {

    /**
     * @param CM_Frontend_Environment $environment
     * @param array                   $userInput
     * @return Denkmal_Model_FacebookPage|string
     * @throws CM_Exception_FormFieldValidation
     */
    public function validate(\CM_Frontend_Environment $environment, $userInput) {
        $value = parent::validate($environment, $userInput);
        if (null === $value) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Invalid data.'));
        }
        if ($facebookPage = Denkmal_Model_FacebookPage::findByFacebookId($value)) {
            $value = $facebookPage;
        } else {
            $graphPage = $this->_getGraphPage($value);
            $value = Denkmal_Model_FacebookPage::create($graphPage->getId(), $graphPage->getName());
        }

        return $value;
    }

    /**
     * @param Denkmal_Model_FacebookPage $item
     * @param CM_Frontend_Render         $render
     * @return array
     */
    public function getSuggestion($item, CM_Frontend_Render $render) {
        return ['id' => $item->getFacebookId(), 'name' => $item->getName()];
    }

    protected function _getSuggestions($term, array $options, CM_Frontend_Render $render) {
        $term = (string) $term;
        $suggestions = [];
        if ($graphPage = $this->_findGraphPage($term)) {
            $suggestions[] = ['id' => $graphPage->getId(), 'name' => $graphPage->getName()];
        }
        if (empty($suggestions)) {
            $pageList = new Denkmal_Paging_FacebookPage_All();
            /** @var $item Denkmal_Model_FacebookPage */
            foreach ($pageList as $item) {
                if (0 === stripos($item->getName(), $term) || 0 === stripos($item->getFacebookId(), $term)) {
                    $suggestions[] = $this->getSuggestion($item, $render);
                }
            }
        }
        return $suggestions;
    }

    /**
     * @param string $searchTerm
     * @return \Facebook\GraphNodes\GraphPage
     * @throws CM_Exception_FormFieldValidation
     */
    private function _getGraphPage($searchTerm) {
        $searchTerm = (string) $searchTerm;
        if (0 === strlen($searchTerm)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Empty search term.'));
        }

        $serviceManager = CM_Service_Manager::getInstance();
        /** @var \Facebook\Facebook $facebookClient */
        $facebookClient = $serviceManager->get('facebook', '\Facebook\Facebook');

        try {
            $response = $facebookClient->get('/' . $searchTerm);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Failed to retrieve facebook page: ' . $e->getMessage()));
        }
        $graphPage = $response->getGraphPage();
        if (!$graphPage->getId()) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Facebook page has no ID.'));
        }
        if (!$graphPage->getName()) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Facebook page has no name.'));
        }
        return $response->getGraphPage();
    }

    /**
     * @param string $searchTerm
     * @return \Facebook\GraphNodes\GraphPage|null
     */
    private function _findGraphPage($searchTerm) {
        try {
            return $this->_getGraphPage($searchTerm);
        } catch (CM_Exception_FormFieldValidation $e) {
            return null;
        }
    }

}
