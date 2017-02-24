<?php

class Denkmal_App_SetupScript_EventCategories extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        Denkmal_Model_EventCategory::create('elektro', new CM_Color_RGB(255, 255, 0), ['techno', 'house', 'minimal']);
        Denkmal_Model_EventCategory::create('pop', new CM_Color_RGB(255, 0, 0), ['pop', 'disco', 'funk']);

        $this->_setLoaded(true);
    }
}
