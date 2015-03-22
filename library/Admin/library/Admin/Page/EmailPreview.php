<?php

class Admin_Page_EmailPreview extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $emails = array(
            'Admin_Mail_EventNotification',
            'Denkmal_Mail_UserInvite',
        );
        $class = $this->getParams()->getString('class', reset($emails));
        switch ($class) {
            case 'Admin_Mail_EventNotification':
                $event = new Denkmal_Model_Event(CM_Db_Db::getRandId('denkmal_model_event', 'id'));
                $email = new Admin_Mail_EventNotification($event);
                break;
            case 'Denkmal_Mail_UserInvite':
                $inviter = $environment->getViewer(true);
                $userInvite = new Denkmal_Model_UserInvite();
                $userInvite->setInviter($inviter);
                $userInvite->setEmail('foo@example.com');
                $userInvite->setKey('abcdefghijkl');
                $userInvite->setExpires((new DateTime())->modify('+30 days'));
                $email = new Denkmal_Mail_UserInvite($userInvite);
                break;
            default:
                throw new CM_Exception_Invalid('No valid mail specified');
        }

        $viewResponse->set('activeEmail', $class);
        $viewResponse->set('emailList', $emails);
        $viewResponse->set('email', $email);
    }
}
