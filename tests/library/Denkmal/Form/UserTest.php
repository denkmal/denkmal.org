<?php

class Denkmal_Form_UserTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcess() {
        $admin = Denkmal_Model_User::create('admin@denkmal.org', 'admin', 'pass');
        $admin->getRoles()->add(Denkmal_Role::ADMIN);

        $form = new Denkmal_Form_User();
        $action = new Denkmal_FormAction_User_Create($form);
        $request = $this->createRequestFormAction($action, [
            'email'    => 'foo@example.com',
            'username' => 'foo',
            'password' => 'pass'
        ]);
        $request->mockMethod('getViewer')->set($admin);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response);

        $user = Denkmal_Model_User::findByEmail('foo@example.com');
        $this->assertNotNull($user);
        $this->assertSame(null, $user->getLanguage());
        $this->assertSame('foo@example.com', $user->getEmail());
        $this->assertSame('foo', $user->getUsername());

        $this->assertEquals($user, Denkmal_Model_User::authenticate('foo@example.com', 'pass'));
    }

    public function testProcessOnlyAdmin() {
        $publisher = Denkmal_Model_User::create('publisher@denkmal.org', 'publisher', 'pass');
        $publisher->getRoles()->add(Denkmal_Role::PUBLISHER);

        $form = new Denkmal_Form_User();
        $action = new Denkmal_FormAction_User_Create($form);
        $request = $this->createRequestFormAction($action, [
            'email'    => 'foo@example.com',
            'username' => 'foo',
            'password' => 'pass'
        ]);
        $request->mockMethod('getViewer')->set($publisher);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response);
    }

    public function testProcessWithInvite() {
        $inviter = Denkmal_Model_User::create('inviter@denkmal.org', 'inviter', 'pass');
        $userInvite = Denkmal_Model_UserInvite::create($inviter);

        $form = new Denkmal_Form_User(['inviteKey' => $userInvite->getKey()]);
        $action = new Denkmal_FormAction_User_Create($form);
        $request = $this->createRequestFormAction($action, [
            'email'    => 'foo@example.com',
            'username' => 'foo',
            'password' => 'pass'
        ]);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response);

        $user = Denkmal_Model_User::findByEmail('foo@example.com');
        $this->assertNotNull($user);
        $this->assertSame('foo@example.com', $user->getEmail());
        $this->assertSame('foo', $user->getUsername());

        $this->assertEquals($user, Denkmal_Model_User::authenticate('foo@example.com', 'pass'));

        $this->assertModelNotInstantiable($userInvite);
    }
}
