<?php

class Denkmal_Form_ChangePasswordTest extends DenkmalTest_TestCase {

    public function testProcessAction() {
        $form = new Denkmal_Form_ChangePassword();
        $formAction = new Denkmal_FormAction_ChangePassword_Process($form);
        $data = ["old_password"         => "blabla",
                 "new_password"         => "blabla1",
                 "new_password_confirm" => "blabla1"
        ];
        $user = DenkmalTest_TH::createUser();
        $user->setPassword('blabla');

        $request = $this->createRequestFormAction($formAction, $data);
        $response = $this->processRequestWithViewer($request, $user);
        $this->assertFormResponseSuccess($response, 'Passwort wurde geändert.');
        $this->assertTrue((bool) Denkmal_App_Auth::checkLogin($user->getEmail(), 'blabla1'));
    }

    public function testWrongUser() {
        $form = new Denkmal_Form_ChangePassword();
        $formAction = new Denkmal_FormAction_ChangePassword_Process($form);
        $data = ["old_password"         => "blabla",
                 "new_password"         => "blabla1",
                 "new_password_confirm" => "blabla1"
        ];
        $user = DenkmalTest_TH::createUser();
        $user->setPassword('blabla');
        $wrongUser = DenkmalTest_TH::createUser();

        $request = $this->createRequestFormAction($formAction, $data);
        $response = $this->processRequestWithViewer($request, $wrongUser);
        $this->assertFormResponseError($response, 'Falsches altes Passwort.', 'old_password');
        $this->assertFalse((bool) Denkmal_App_Auth::checkLogin($user->getEmail(), 'blabla1'));
    }
}
