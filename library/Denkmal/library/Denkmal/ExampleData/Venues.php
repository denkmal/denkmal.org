<?php

class Denkmal_ExampleData_Venues extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        Denkmal_Model_Venue::create('Sääli Zum Goldenen Fass', false, false, null, null, new CM_Geo_Point(47.5657, 7.59567));
        Denkmal_Model_Venue::create('Kaserne', false, false, null, null, new CM_Geo_Point(47.5636, 7.5905));
        Denkmal_Model_Venue::create('Kaschemme', false, false, null, null, new CM_Geo_Point(47.5435, 7.6205));
        Denkmal_Model_Venue::create('Fame Club', false, false, null, null, new CM_Geo_Point(47.5619, 7.59508));

        $this->_setLoaded(true);
    }
}
