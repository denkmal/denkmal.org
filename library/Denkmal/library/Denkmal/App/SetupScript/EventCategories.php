<?php

class Denkmal_App_SetupScript_EventCategories extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        Denkmal_Model_EventCategory::create('e-music', CM_Color_RGB::fromHexString('#e8e2c3'),
            ['classic', 'new music', 'jazz', 'impro', 'jamsession']);

        Denkmal_Model_EventCategory::create('blues', CM_Color_RGB::fromHexString('#cde0ef'),
            ['blues', 'country', 'folk', 'african', 'world', 'singer-songwriter', 'gipsy']);

        Denkmal_Model_EventCategory::create('pop', CM_Color_RGB::fromHexString('#efcdee'),
            ['pop', 'disco', 'dance', 'salsa', 'funk', 'soul', '80s', '90s', '2000', 'indie']);

        Denkmal_Model_EventCategory::create('rock', CM_Color_RGB::fromHexString('#dadada'),
            ['rock', 'hard rock', 'metal', 'punk', 'garage', 'rocksteady', 'rock’n’roll']);

        Denkmal_Model_EventCategory::create('electronic', CM_Color_RGB::fromHexString('#efcdcd'),
            ['electronic', 'electro', 'techno', 'house', 'minimal', 'tech house', 'uk bass']);

        Denkmal_Model_EventCategory::create('dnb', CM_Color_RGB::fromHexString('#cdefdc'),
            ['drum’n’bass', 'psy', 'goa', 'psy-trance', 'tekk']);

        Denkmal_Model_EventCategory::create('hiphop', CM_Color_RGB::fromHexString('#DEE6DD'),
            ['hiphop', 'dancehall', 'r’n’b', 'reggae', 'dub']);

        Denkmal_Model_EventCategory::create('performance', CM_Color_RGB::fromHexString('#fbe5b5'),
            ['vernissage', 'reading', 'screening', 'performance', 'fussball']);

        $this->_setLoaded(true);
    }
}
