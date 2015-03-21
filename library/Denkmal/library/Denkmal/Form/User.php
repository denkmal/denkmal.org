<?php

class Denkmal_Form_User extends \CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new CM_FormField_Text(['name' => 'username']));
        $this->registerField(new CM_FormField_Password(['name' => 'password']));

        $this->registerAction(new Denkmal_FormAction_User_Create($this));
        $this->registerAction(new Denkmal_FormAction_User_Save($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        if ($params->has('user')) {
            $user = $params->getUser('user');
            $this->getField('email')->setValue($user->getEmail());
            $this->getField('username')->setValue($user->getUsername());
        }
    }
}
