<?php

class Denkmal_App_SetupScript_EventCategories extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        Denkmal_Model_EventCategory::create('e-music', CM_Color_RGB::fromHexString('#FBB4AE'),
            ['classic', 'new music', 'jazz', 'impro', 'jamsession']);

        Denkmal_Model_EventCategory::create('blues', CM_Color_RGB::fromHexString('#B3CDE3'),
            ['blues', 'country', 'folk', 'african', 'world', 'singer-songwriter', 'gipsy']);

        Denkmal_Model_EventCategory::create('pop', CM_Color_RGB::fromHexString('#DEE6DD'),
            ['pop', 'disco', 'dance', 'salsa', 'funk', 'soul', '80s', '90s', '2000', 'indie']);

        Denkmal_Model_EventCategory::create('rock', CM_Color_RGB::fromHexString('#DECBE4'),
            ['rock', 'hard rock', 'metal', 'punk', 'garage', 'rocksteady', 'rock’n’roll']);

        Denkmal_Model_EventCategory::create('electronic', CM_Color_RGB::fromHexString('#FED9A6'),
            ['electronic', 'electro', 'techno', 'house', 'minimal', 'tech house', 'uk bass']);

        Denkmal_Model_EventCategory::create('dnb', CM_Color_RGB::fromHexString('#FFFFCC'),
            ['drum’n’bass', 'psy', 'goa', 'psy-trance', 'tekk']);

        Denkmal_Model_EventCategory::create('hiphop', CM_Color_RGB::fromHexString('#E5D8BD'),
            ['hiphop', 'dancehall', 'r’n’b', 'reggae', 'dub']);

        Denkmal_Model_EventCategory::create('performance', CM_Color_RGB::fromHexString('#FDDAEC'),
            ['vernissage', 'reading', 'screening', 'performance', 'fussball']);

        $this->_setLoaded(true);
    }
}
