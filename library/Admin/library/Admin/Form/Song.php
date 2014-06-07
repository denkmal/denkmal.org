<?php

class Admin_Form_Song extends CM_Form_Abstract {

    protected function _initialize() {
        $this->registerField(new CM_FormField_Hidden(['name' => 'songId']));
        $this->registerField(new CM_FormField_Text(['name' => 'label']));
        $this->registerField(new Denkmal_FormField_FileSong(['name' => 'files']));

        $this->registerAction(new Admin_FormAction_Song_Add($this));
        $this->registerAction(new Admin_FormAction_Song_Save($this));
        $this->registerAction(new Admin_FormAction_Song_Delete($this));
    }

    public function prepare(CM_Frontend_Environment $environment) {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();

        if ($params->has('song')) {
            $song = $params->getSong('song');
            $this->getField('songId')->setValue($song->getId());
            $this->getField('label')->setValue($song->getLabel());
        }
    }
}
