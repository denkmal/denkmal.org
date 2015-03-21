<?php

class Denkmal_Page_SignUp extends \Denkmal_Page_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $inviteKey = $this->_params->getString('invite');

        $userInvite = Denkmal_Model_UserInvite::findByKey($inviteKey);

        $viewResponse->set('userInvite', $userInvite);
    }
}
