<?php

class Admin_Component_EventCategory extends \Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $eventCategory = $this->_params->getEventCategory('eventCategory');

        $viewResponse->set('eventCategory', $eventCategory);
    }

    public function ajax_removeGenre(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $eventCategory = $this->_params->getEventCategory('eventCategory');
        $genre = $params->getString('genre');

        $eventCategory->removeGenre($genre);

        $response->reloadComponent();
    }

}
