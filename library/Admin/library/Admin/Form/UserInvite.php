<?php

class Admin_Form_UserInvite extends \CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new CM_FormField_Date(['name' => 'expires']));

        $this->registerAction(new Admin_FormAction_UserInvite_Create($this));
        $this->registerAction(new Admin_FormAction_UserInvite_Save($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        if ($params->has('userInvite')) {
            $userInvite = $params->getUserInvite('userInvite');
            $this->getField('email')->setValue($userInvite->getEmail());
            $this->getField('expires')->setValue($userInvite->getExpires());
        } else {
            $this->getField('expires')->setValue((new DateTime())->modify('+30 days'));
        }
    }
}
