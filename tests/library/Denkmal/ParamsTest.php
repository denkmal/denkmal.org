<?php

class Denkmal_ParamsTest extends CMTest_TestCase {

    public function testGetVenue() {
        $venue = DenkmalTest_TH::createVenue();

        $params = new Denkmal_Params(array('venue1' => $venue, 'venue2' => $venue->getId()), true);

        $this->assertEquals($venue, $params->getVenue('venue1'));
        $this->assertEquals($venue, $params->getVenue('venue2'));
    }

    public function testGetSong() {
        $file = CM_File::createTmp();
        $song = Denkmal_Model_Song::create('Foo', $file);

        $params = new Denkmal_Params(array('song1' => $song, 'song2' => $song->getId()), true);

        $this->assertEquals($song, $params->getSong('song1'));
        $this->assertEquals($song, $params->getSong('song2'));
    }

    public function testGetDate() {
        $date = DateTime::createFromFormat('Y-n-j', '2013-03-12');
        $date->setTime(0, 0);
        $params = new Denkmal_Params(array('date1' => $date->format('Y-n-j')), true);

        $this->assertEquals($date, $params->getDate('date1'));
    }

    /**
     * @expectedException CM_Exception_InvalidParam
     */
    public function testGetDateInvalidString() {
        $params = new Denkmal_Params(array('date1' => 'foo'), true);
        $params->getDate('date1');
    }

    /**
     * @expectedException CM_Exception_InvalidParam
     */
    public function testGetDateInvalidDate() {
        $params = new Denkmal_Params(array('date1' => '2013-03-99'), true);
        $params->getDate('date1');
    }

    public function testGetUser() {
        $user = new Denkmal_Model_User();
        $params = new Denkmal_Params(array('user1' => $user), true);

        $this->assertSame($user, $params->getUser('user1'));
    }

    /**
     * @expectedException CM_Exception_Invalid
     */
    public function testGetUserNotDenkmal() {
        $user = new CM_Model_User();
        $params = new Denkmal_Params(array('user1' => $user), true);
        $params->getUser('user1');
    }
}
