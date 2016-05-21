<?php

class Denkmal_App_SetupScript_Locations extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $switzerland = CM_Model_Location::createCountry('Switzerland', 'CH');
        $baselStadt = CM_Model_Location::createState($switzerland, 'Basel-Stadt', null, 'CH04');
        $basel = CM_Model_Location::createCity($baselStadt, 'Basel', 47.5584, 7.5733, '16518');

        $austria = CM_Model_Location::createCountry('Austria', 'AT');
        $steiermark = CM_Model_Location::createState($austria, 'Steiermark', null, 'AT06');
        $graz = CM_Model_Location::createCity($steiermark, 'Graz', 47.0667, 15.45, '16516');
        
        Denkmal_Model_Region::create('Basel', 'basel', 'BSL', $basel);
        Denkmal_Model_Region::create('Graz', 'graz', 'GRZ', $graz);

        $this->_setLoaded(true);
    }
}
