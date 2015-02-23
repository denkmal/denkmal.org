<?php

class Denkmal_Form_MessageTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testProcessAll() {
        $user = Denkmal_Model_User::create('foo@example.com', 'foo', 'pass');
        $user->getRoles()->add(Denkmal_Role::HIPSTER);
        $venue = Denkmal_Model_Venue::create('Foo', false, false);
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');
        $image = new CM_File(DIR_TEST_DATA . '/image.jpg');
        $imageUsercontent = CM_File_UserContent_Temp::create('image.jpg', $image->read());

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => 'Hello world',
            'tags'  => CM_Params::jsonEncode([$tag1->getId(), $tag2->getId()]),
            'image' => [$imageUsercontent->getUniqid()],
        ]);
        $request->mockMethod('getClientId')->set(12);
        $request->mockMethod('getViewer')->set($user);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
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
        $venue = Denkmal_Model_Venue::create('Foo', false, false);
        $tag1 = Denkmal_Model_Tag::create('tag1');
        $tag2 = Denkmal_Model_Tag::create('tag2');

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => '',
            'tags'  => CM_Params::jsonEncode([$tag1->getId(), $tag2->getId()]),
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
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
        $venue = Denkmal_Model_Venue::create('Foo', false, false);

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => '',
            'tags'  => CM_Params::jsonEncode([]),
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Bitte Nachricht eingeben', 'tags');
    }

    public function testProcessAnonymousMessagingDisabled() {
        $site = new Denkmal_Site();
        $site->setAnonymousMessagingDisabled(true);

        $venue = Denkmal_Model_Venue::create('Foo', false, false);

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'text'  => 'Hello',
            'tags'  => CM_Params::jsonEncode([]),
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Zugriff gesperrt');
    }

    public function testProcessImageNotAllowed() {
        $venue = Denkmal_Model_Venue::create('Foo', false, false);
        $image = new CM_File(DIR_TEST_DATA . '/image.jpg');
        $imageUsercontent = CM_File_UserContent_Temp::create('image.jpg', $image->read());

        $form = new Denkmal_Form_Message();
        $action = new Denkmal_FormAction_Message_Create($form);
        $request = $this->createRequestFormAction($action, [
            'venue' => $venue->getId(),
            'image' => [$imageUsercontent->getUniqid()],
            'tags'  => CM_Params::jsonEncode([]),
        ]);
        $request->mockMethod('getClientId')->set(12);
        $response = new CM_Http_Response_View_Form($request, $this->getServiceManager());
        $response->process();

        $this->assertFormResponseError($response, 'Bildupload nicht erlaubt');
    }
}
