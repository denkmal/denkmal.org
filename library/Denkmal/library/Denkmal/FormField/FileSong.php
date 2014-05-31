<?php

class Denkmal_FormField_FileSong extends CM_FormField_File {

    protected function _initialize() {
        $this->_params->set('cardinality', 1);
        parent::_initialize();
    }

    protected function _getAllowedExtensions() {
        return array('mp3');
    }
}
