<?php

class Admin_Form_UserEdit extends \CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Email(['name' => 'email']));
        $this->registerField(new CM_FormField_Text(['name' => 'username', 'lengthMin' => 2, 'lengthMax' => 15]));
        $this->registerField(new CM_FormField_Password(['name' => 'password']));

        $this->registerAction(new Admin_FormAction_UserEdit_Save($this));
    }

    protected function _getRequiredFields() {
        return array('email', 'username');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        $user = $params->getUser('user');
        $this->getField('email')->setValue($user->getEmail());
        $this->getField('username')->setValue($user->getUsername());
    }
}
