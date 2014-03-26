<?php

class Denkmal_FormField_Time extends CM_FormField_Abstract {

    public function validate($userInput, CM_Response_Abstract $response) {
        if (!preg_match('/^(\d{1,2})(?::(\d{2}))?$/', $userInput, $matches)) {
            throw new CM_Exception_FormFieldValidation('Invalid time');
        }
        $hour = (int) $matches[1];
        $minute = array_key_exists(2, $matches) ? $matches[2] : 0;
        if ($hour > 24 || $minute > 60 || ($hour === 24 && $minute > 0)) {
            throw new CM_Exception_FormFieldValidation('Invalid time');
        }
        return new DateInterval('PT' . $hour . 'H' . $minute . 'M');
    }

    public function prepare(array $params) {
        $this->setTplParam('class', isset($params['class']) ? $params['class'] : null);
        $this->setTplParam('placeholder', isset($params['placeholder']) ? $params['placeholder'] : null);
    }
}
