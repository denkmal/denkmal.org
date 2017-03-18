<?php

class Denkmal_App_SetupScript_LoadLanguage extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $de = CM_Model_Language::create('Deutsch', 'de', true);
        $en = CM_Model_Language::create('English', 'en', true, $de);

        $this->_setLoaded(true);
    }
}
