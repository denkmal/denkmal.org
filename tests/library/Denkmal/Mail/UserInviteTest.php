<?php

class Denkmal_Mail_UserInviteTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testRender() {
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'passwd');
        $userInvite = Denkmal_Model_UserInvite::create($user, 'bar@example.com');

        $mail = new Denkmal_Mail_UserInvite($userInvite);
        list($subject, $html, $text) = $mail->render();

        $this->assertSame([['address' => 'bar@example.com', 'name' => null]], $mail->getTo());
        $this->assertContains('Invitation', $subject);
        $this->assertContains('Create Account', $html);
    }
}
