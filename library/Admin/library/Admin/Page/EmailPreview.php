<?php

class Admin_Page_EmailPreview extends Admin_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $emails = array(
            'Admin_Mail_EventNotification',
        );
        $class = $this->getParams()->getString('class', reset($emails));
        switch ($class) {
            case 'Admin_Mail_EventNotification':
                $event = new Denkmal_Model_Event(CM_Db_Db::getRandId('denkmal_model_event', 'id'));
                $email = new Admin_Mail_EventNotification($event);
                break;
            default:
                throw new CM_Exception_Invalid('No valid mail specified');
        }

        $viewResponse->set('activeEmail', $class);
        $viewResponse->set('emailList', $emails);
        $viewResponse->set('email', $email);
    }
}
