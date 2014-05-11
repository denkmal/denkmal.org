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

    public function testIsActive() {
        $suspension = new Denkmal_Suspension();
        $suspension->setUntil(null);
        $this->assertSame(false, $suspension->isActive());

        $date = new DateTime();
        $date->add(new DateInterval('PT1H'));
        $suspension->setUntil($date);
        $this->assertSame(true, $suspension->isActive());

        $date = new DateTime();
        $date->sub(new DateInterval('PT1H'));
        $suspension->setUntil($date);
        $this->assertSame(false, $suspension->isActive());
    }
}
