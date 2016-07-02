<?php

class Denkmal_Form_MessageTest extends CMTest_TestCase {

    protected function setUp() {
        $setupLocations = new Denkmal_App_SetupScript_Locations($this->getServiceManager());
        $setupLocations->load(new CM_OutputStream_Null());
    }

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessAll() {
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        $user->getRoles()->add(Denkmal_Role::HIPSTER);
        $venue = DenkmalTest_TH::createVenue();
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $image = new CM_File(DIR_TEST_DATA . '/image.jpg');
        $imageUsercontent = CM_File_UserContent_Temp::create('image.jpg', $image->read());

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => 'Hello world',
            'tags'  => [$tag1->getId(), $tag2->getId()],
            'image' => [$imageUsercontent->getUniqid()],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $request->mockMethod('getViewer')->set($user);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response);

        /** @var Denkmal_Model_Message $message */
        $message = (new Denkmal_Paging_Message_All())->getItem(0);

        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame('12', $message->getClientId());
        $this->assertEquals($user, $message->getUser());
        $this->assertSame('Hello world', $message->getText());
        $this->assertNotNull($message->getImage());
        $this->assertEquals([$tag1, $tag2], $message->getTags()->getAll());
    }

    public function testProcessOnlyTags() {
        $venue = DenkmalTest_TH::createVenue();
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => '',
            'tags'  => [$tag1->getId(), $tag2->getId()],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseSuccess($response);

        /** @var Denkmal_Model_Message $message */
        $message = (new Denkmal_Paging_Message_All())->getItem(0);

        $this->assertEquals($venue, $message->getVenue());
        $this->assertSame('12', $message->getClientId());
        $this->assertEquals([$tag1, $tag2], $message->getTags()->getAll());
        $this->assertSame(null, $message->getUser());
        $this->assertSame(null, $message->getText());
        $this->assertSame(null, $message->getImage());
    }

    public function testProcessNone() {
        $venue = DenkmalTest_TH::createVenue();

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => '',
            'tags'  => [],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Please add a message.', 'tags');
    }

    public function testProcessAnonymousMessagingDisabled() {
        $settings = new Denkmal_App_Settings();
        $settings->setAnonymousMessagingDisabled(true);

        $venue = DenkmalTest_TH::createVenue();

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => 'Hello',
            'tags'  => [],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Access denied!');
    }

    public function testProcessAnonymousImageNotAllowed() {
        $venue = DenkmalTest_TH::createVenue();
        $image = new CM_File(DIR_TEST_DATA . '/image.jpg');
        $imageUsercontent = CM_File_UserContent_Temp::create('image.jpg', $image->read());

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $site = $this->getMockSite('Denkmal_Site_Default');
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'image' => [$imageUsercontent->getUniqid()],
            'tags'  => [],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = CM_Http_Response_View_Form::createFromRequest($request, $site, $this->getServiceManager());
        $response->process();

        if (Denkmal_Form_Message::getImageAllowed(null)) {
            $this->assertFormResponseSuccess($response);
        } else {
            $this->assertFormResponseError($response, 'Bildupload nicht erlaubt');
        }
    }
}
