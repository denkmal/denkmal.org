<?php

class Denkmal_FormField_Region extends CM_FormField_Set_Select {

    protected function _initialize() {
        $values = array();
        /** @var Denkmal_Model_Region $region */
        foreach (new Denkmal_Paging_Region_All() as $region) {
            $values[$region->getId()] = $region->getName();
        }
        $this->_params->set('values', $values);
        $this->_params->set('labelsInValues', true);
        parent::_initialize();
    }

    /**
     * @param CM_Frontend_Environment $environment
     * @param int                     $userInput
     * @return Denkmal_Model_Region
     */
    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $userInput = parent::validate($environment, $userInput);
        return new Denkmal_Model_Region($userInput);
    }

}
