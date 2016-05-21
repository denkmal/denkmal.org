<?php

class Denkmal_FormField_Time extends CM_FormField_Text {

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $userInput = parent::validate($environment, $userInput);

        if (!preg_match('/^(\d{1,2})(?:[:\.](\d{2}))?$/', $userInput, $matches)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Illegal time format.'));
        }
        $hour = (int) $matches[1];
        $minute = array_key_exists(2, $matches) ? $matches[2] : 0;
        if ($hour > 24 || $minute > 60 || ($hour === 24 && $minute > 0)) {
            throw new CM_Exception_FormFieldValidation(new CM_I18n_Phrase('Illegal time format.'));
        }
        return new DateInterval('PT' . $hour . 'H' . $minute . 'M');
    }
}
