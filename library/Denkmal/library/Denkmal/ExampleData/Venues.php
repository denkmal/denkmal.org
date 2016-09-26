<?php

class Denkmal_ExampleData_Venues extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $baselRegion = Denkmal_Model_Region::getBySlug('basel');
        Denkmal_Model_Venue::create('Sääli Zum Goldenen Fass', false, false, $baselRegion, null, null, new CM_Geo_Point(47.5657, 7.59567));
        Denkmal_Model_Venue::create('Kaserne', false, false, $baselRegion, null, null, new CM_Geo_Point(47.5636, 7.5905));
        Denkmal_Model_Venue::create('Kaschemme', false, false, $baselRegion, null, null, new CM_Geo_Point(47.5435, 7.6205));
        Denkmal_Model_Venue::create('Fame Club', false, false, $baselRegion, null, null, new CM_Geo_Point(47.5619, 7.59508));

        $grazRegion = Denkmal_Model_Region::getBySlug('graz');
        $ppc = Denkmal_Model_Venue::create('p.p.c.', false, false, $grazRegion, 'http://www.popculture.at/', null, new CM_Geo_Point(47.0758748, 15.4293715));
        $ppc->setFacebookPage(Denkmal_Model_FacebookPage::create('107999242559061', 'ppcgraz'));
        Denkmal_Model_Venue::create('Postgarage', false, false, $grazRegion, 'http://www.postgarage.at', null, new CM_Geo_Point(47.066073, 15.4281812));
        Denkmal_Model_Venue::create('Forum Stadtpark', false, false, $grazRegion, 'http://www.forumstadtpark.at', null, new CM_Geo_Point(47.0746787, 15.4413251));

        $this->_setLoaded(true);
    }
}
