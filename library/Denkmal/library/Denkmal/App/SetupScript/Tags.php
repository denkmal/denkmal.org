<?php

class Denkmal_App_SetupScript_Tags extends CM_Provision_Script_OptionBased {

    public function load(CM_OutputStream_Interface $output) {
        $labelList = [
            'beer',
            'cat',
            'chicken',
            'cock',
            'disguise',
            'elefant',
            'food',
            'guitar',
            'moustache',
            'party',
            'peace',
            'rabbit',
            'rock',
            'sexy',
            'suit',
            'trash',
            'disco',
            'sleep',
            'heart',
            'coffee',
            'foosball',
            'loud',
        ];

        foreach ($labelList as $label) {
            Denkmal_Model_Tag::create($label);
        }

        $this->_setLoaded(true);
    }
}
