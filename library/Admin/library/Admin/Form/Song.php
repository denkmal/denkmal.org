<?php

class Admin_Form_Song extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Text(['name' => 'label']));
        $this->registerField(new Denkmal_FormField_FileSong(['name' => 'files']));

        $this->registerAction(new Admin_FormAction_Song_Add($this));
        $this->registerAction(new Admin_FormAction_Song_Save($this));
    }

    protected function _getRequiredFields() {
        return array('label');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        if ($params->has('song')) {
            $song = $params->getSong('song');
            $this->getField('label')->setValue($song->getLabel());
            $this->getField('files')->setValue([$song->getFile()]);
        }
    }

    public function ajax_deleteSong(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $song = $params->getSong('song');

        if (!$response->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN, Denkmal_Role::PUBLISHER)) {
            throw new CM_Exception_NotAllowed();
        }

        $song->delete();
    }

}
