<?php

class Denkmal_SuspensionTest extends CMTest_TestCase {

    public function testGetSetUntil() {
        $site = new Denkmal_Site();
        $suspension = new Denkmal_Suspension($site);
        $this->assertSame(null, $suspension->getUntil());

        $date = new DateTime();
        $suspension->setUntil($date);
        $this->assertEquals($date, $suspension->getUntil());

        $suspension->setUntil(null);
        $this->assertSame(null, $suspension->getUntil());
    }

    public function testIsActive() {
        $site = new Denkmal_Site();
        $suspension = new Denkmal_Suspension($site);
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

    public function testGetDaysLeft() {
        $site = new Denkmal_Site();
        $suspension = new Denkmal_Suspension($site);
        $suspension->setUntil(null);
        $this->assertSame(0, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT3H'));
        $suspension->setUntil($date);
        $this->assertSame(1, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT17H'));
        $suspension->setUntil($date);
        $this->assertSame(1, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->add(new DateInterval('PT25H'));
        $suspension->setUntil($date);
        $this->assertSame(2, $suspension->getDaysLeft());

        $date = new DateTime();
        $date->sub(new DateInterval('PT3H'));
        $suspension->setUntil($date);
        $this->assertSame(0, $suspension->getDaysLeft());
    }
}
