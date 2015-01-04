<?php

class Denkmal_FormField_TwitterUsername extends CM_FormField_Text {

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        if ('@' === substr($userInput, 0, 1)) {
            $userInput = substr($userInput, 1);
        }

        if (preg_match('#[^\w]#', $userInput)) {
            throw new CM_Exception_FormFieldValidation('Contains invalid characters');
        }

        return parent::validate($environment, $userInput);
    }
}
