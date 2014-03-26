<?php

class Admin_Component_Link extends Admin_Component_Abstract {

    public function prepare() {
        $link = $this->_params->getLink('link');

        $this->setTplParam('link', $link);
    }
}
