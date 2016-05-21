<?php

class Denkmal_App_SetupScript_Locations extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $country = CM_Model_Location::createCountry('Switzerland', 'CH');
        $state = CM_Model_Location::createState($country, 'Basel-Stadt', null, 'CH04');
        $basel = CM_Model_Location::createCity($state, 'Basel', 47.5584, 7.5733, '16518');
        $country = CM_Model_Location::createCountry('Austria', 'AT');
        $state = CM_Model_Location::createState($country, 'Steiermark', null, 'AT06');
        CM_Model_Location::createCity($state, 'Graz', 47.0667, 15.45, '16516');
        Denkmal_Model_Region::create('Basel', 'basel', 'BSL', $basel);

        $this->_setLoaded(true);
    }
}
