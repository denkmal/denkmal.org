<?php

class Admin_Form_Translation extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Textarea(['name' => 'value']));
        $this->registerAction(new Admin_FormAction_Translation_Save($this));
        $this->registerAction(new Admin_FormAction_Translation_Unset($this));
    }

    protected function _getRequiredFields() {
        return array('language', 'key');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        $params = $this->getParams();
        $this->getField('value')->setValue($params->getString('value', ''));
    }

    /**
     * @param Denkmal_Model_User $user
     * @return bool
     */
    public function canEdit(Denkmal_Model_User $user) {
        return $user->getRoles()->contains(Denkmal_Role::ADMIN);
    }
}
