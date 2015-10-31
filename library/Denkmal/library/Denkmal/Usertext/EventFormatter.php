<?php

class Denkmal_Usertext_EventFormatter extends CM_Usertext_Usertext {

    public function __construct() {
        $this->addFilter(new CM_Usertext_Filter_Escape());
        $this->addFilter(new Denkmal_Usertext_Filter_Links());
    }
}
