<?php

class Admin_Component_EventLinkList extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $event = $this->_params->getEvent('event');

        $eventLinkList = new Denkmal_Paging_EventLink_Event($event);

        $viewResponse->set('event', $event);
        $viewResponse->set('eventLinkList', $eventLinkList);
    }

    public function ajax_deleteEventLink(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        /** @var Denkmal_Params $params */
        $eventLink = $params->getEventLink('id');
        $eventLink->delete();
        $response->reloadComponent();
    }
}
