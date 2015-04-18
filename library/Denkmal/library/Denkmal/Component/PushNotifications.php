<?php

class Denkmal_Component_PushNotifications extends \Denkmal_Component_Abstract {

    public function prepare(\CM_Frontend_Environment $environment, \CM_Frontend_ViewResponse $viewResponse) {
    }

    public function ajax_storePush(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $subscriptionId = $params->getString('subscriptionId');
        $endpoint = $params->getString('endpoint');
        $user = $params->has('user') ? $params->getUser('user') : null;

        $pushSubscription = Denkmal_Push_Subscription::findBySubscriptionIdAndEndpoint($subscriptionId, $endpoint);

        if (!$pushSubscription) {
            Denkmal_Push_Subscription::create($subscriptionId, $endpoint, $user);
        }
    }
}
