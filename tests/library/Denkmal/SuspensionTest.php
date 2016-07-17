<?php

class Denkmal_SuspensionTest extends CMTest_TestCase {

    public function testGetUntil() {
        $suspension = new Denkmal_Suspension(null);
        $this->assertSame(null, $suspension->getUntil());

        $date = new DateTime();
        $suspension = new Denkmal_Suspension($date);
        $this->assertEquals($date, $suspension->getUntil());
    }

    public function testIsActive() {
        $suspension = new Denkmal_Suspension(null);
        $this->assertSame(false, $suspension->isActive());

        $date = new DateTime();
        $date->add(new DateInterval('PT1H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(true, $suspension->isActive());

        $date = new DateTime();
        $date->sub(new DateInterval('PT1H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(false, $suspension->isActive());
    }

    public function testGetDaysLeft() {
        $suspension = new Denkmal_Suspension(null);
        $this->assertSame(0, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT3H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(1, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT17H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(1, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT25H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(2, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->sub(new DateInterval('PT3H'));
        $suspension = new Denkmal_Suspension($date);
        $this->assertSame(0, $suspension->getDaysLeft());
    }
}
