<?php

class Denkmal_SuspensionTest extends CMTest_TestCase {

    public function testGetSetUntil() {
        $suspension = new Denkmal_Suspension();
        $this->assertSame(null, $suspension->getUntil());

        $date = new DateTime();
        $suspension->setUntil($date);
        $this->assertEquals($date, $suspension->getUntil());

        $suspension->setUntil(null);
        $this->assertSame(null, $suspension->getUntil());
    }
}
