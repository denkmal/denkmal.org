<?php

class Denkmal_EventFormatter_GenresFormatter extends CM_Usertext_Usertext {

    public function __construct() {
        $this->addFilter(new CM_Usertext_Filter_Escape());
        $this->addFilter(new Denkmal_EventFormatter_GenresFilter());
    }
}
