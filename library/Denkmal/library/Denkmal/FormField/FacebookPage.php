<?php

class Denkmal_FormField_FacebookPage extends CM_FormField_Text {

    public function validate(\CM_Frontend_Environment $environment, $userInput) {
        $userInput = parent::validate($environment, $userInput);

        if (preg_match('#[^\d]#', $userInput)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Should only contain digits.'));
        }

        return $userInput;
    }
}
