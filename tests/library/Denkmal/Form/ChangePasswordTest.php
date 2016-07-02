<?php

class Denkmal_Form_ChangePasswordTest extends CMTest_TestCase {

    public function testProcessAction() {
        $form = new Denkmal_Form_ChangePassword();
        $formAction = new Denkmal_FormAction_ChangePassword_Process($form);
        $data = ["old_password"         => "blabla",
                 "new_password"         => "blabla1",
                 "new_password_confirm" => "blabla1"
        ];
        $user = Denkmal_Model_User::create('foo@foo', 'foo', 'pass');
        $user->setPassword('blabla');

        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($formAction, $data);
        $request->mockMethod('getViewer')->set($user);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response, 'Password has been changed.');
        $this->assertTrue((bool) Denkmal_App_Auth::checkLogin($user->getEmail(), 'blabla1'));
    }

    public function testWrongUser() {
        $form = new Denkmal_Form_ChangePassword();
        $formAction = new Denkmal_FormAction_ChangePassword_Process($form);
        $data = ["old_password"         => "blabla",
                 "new_password"         => "blabla1",
                 "new_password_confirm" => "blabla1"
        ];
        $user = Denkmal_Model_User::create('bar@bar', 'bar', 'pass');
        $user->setPassword('blabla');
        $wrongUser = Denkmal_Model_User::create('wrong@bar', 'wrong', 'pass');

        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($formAction, $data);
        $request->mockMethod('getViewer')->set($wrongUser);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Wrong password.', 'old_password');
        $this->assertFalse((bool) Denkmal_App_Auth::checkLogin($user->getEmail(), 'blabla1'));
    }
}
