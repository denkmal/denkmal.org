<?php

class Admin_Form_UserInviteTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcess() {
        $admin = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $admin->getRoles()->add(Denkmal_Role::ADMIN);
        $expires = new DateTime('2015-03-12');

        $form = new Admin_Form_UserInvite();
        $action = new Admin_FormAction_UserInvite_Create($form);
        $request = $this->createRequestFormAction($action, [
            'email'     => 'foo@example.com',
            'expires'   => ['year' => $expires->format('Y'), 'month' => $expires->format('n'), 'day' => $expires->format('j')],
            'sendEmail' => 1,
        ]);
        $request->mockMethod('getViewer')->set($admin);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response);

        /** @var Denkmal_Model_UserInvite $userInvite */
        $userInvite = (new Denkmal_Paging_UserInvite_All())->getItem(0);
        $this->assertNotNull($userInvite);
        $this->assertEquals($admin, $userInvite->getInviter());
        $this->assertSame('foo@example.com', $userInvite->getEmail());
        $this->assertEquals($expires, $userInvite->getExpires());

        $logMailEntry = (new CM_Paging_Log_Mail([CM_Log_Logger::INFO]))->getItem(0);
        $this->assertContains('Invitation', $logMailEntry['message']);
        $this->assertSame('foo@example.com', $logMailEntry['context']['extra']['to'][0]['address']);
    }
}
