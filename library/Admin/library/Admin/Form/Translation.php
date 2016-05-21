<?php

class Admin_Form_Translation extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Textarea(['name' => 'value']));
        $this->registerAction(new Admin_FormAction_Translation_Save($this));
        $this->registerAction(new Admin_FormAction_Translation_Unset($this));
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $params = $this->getParams();
        $this->getField('value')->setValue($params->getString('value', ''));
    }

    /**
     * @param SK_User $user
     * @return bool
     */
    public function canEdit(SK_User $user) {
        $language = $this->getParams()->getLanguage('language');

        if ($user->getRoles()->contains(SK_Role::ADMIN)) {
            return true;
        }
        if ($user->getRoles()->contains(SK_Role::TRANSLATOR) && !$language->equals(CM_Model_Language::findDefault())) {
            return true;
        }
        return false;
    }
}
