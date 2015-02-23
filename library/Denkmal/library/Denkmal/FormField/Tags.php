<?php

class Denkmal_FormField_Tags extends \CM_FormField_Abstract {

    public function validate(\CM_Frontend_Environment $environment, $userInput) {
    }

    public function prepare(CM_Params $renderParams, CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $value = $this->getValue();
        if (null === $value) {
            $value = [];
        }
        $tagIdList = Functional\map($value, function(Denkmal_Model_Tag $tag) {
            return $tag->getId();
        });

        $viewResponse->set('tagListAvailable', $this->_getTagListAvailable());
        $viewResponse->set('tagList', $this->getValue());
        $viewResponse->set('tagIdList', $tagIdList);
        $viewResponse->getJs()->setProperty('tagIdList', $tagIdList);
    }

    /**
     * @return Denkmal_Model_Tag[]
     */
    private function _getTagListAvailable() {
        $tagList = new Denkmal_Paging_Tag_Active();
        return $tagList->getItems();
    }
}
