<?php

class Denkmal_Paging_Region_AllTest extends CMTest_TestCase {

    public function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $region1 = DenkmalTest_TH::createRegion('Regio 1', 'regio1', 'r1');
        $region2 = DenkmalTest_TH::createRegion('Regio 2', 'regio2', 'r2');

        $this->assertEquals(array($region1, $region2), new Denkmal_Paging_Region_All());

        $region3 = DenkmalTest_TH::createRegion('Regio 3', 'regio3', 'r3');
        $this->assertEquals(array($region1, $region2, $region3), new Denkmal_Paging_Region_All());

        $region3->delete();
        $this->assertEquals(array($region1, $region2), new Denkmal_Paging_Region_All());
    }

}
