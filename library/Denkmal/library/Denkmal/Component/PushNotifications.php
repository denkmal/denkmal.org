<?php

class Denkmal_Component_PushNotifications extends \Denkmal_Component_Abstract {

    public function prepare(\CM_Frontend_Environment $environment, \CM_Frontend_ViewResponse $viewResponse) {
        $autoSubscribe = $this->_params->getBoolean('autoSubscribe', false);

        $viewResponse->getJs()->setProperty('autoSubscribe', $autoSubscribe);
    }

    public function ajax_storePushSubscription(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $state = $params->getBoolean('state');
        $subscriptionId = $params->getString('subscriptionId');
        $endpoint = $params->getString('endpoint');
        $user = $params->has('user') ? $params->getUser('user') : null;

        if (!Denkmal_Push_Notification_Provider_Abstract::hasEndpoint($response->getServiceManager(), $endpoint)){
            throw new CM_Exception("Unknown notification endpoint `{$endpoint}`.");
        }

        $pushSubscription = Denkmal_Push_Subscription::findBySubscriptionIdAndEndpoint($subscriptionId, $endpoint);

        if ($state) {
            if ($pushSubscription) {
                $pushSubscription->setUpdated(new DateTime());
                if ($user) {
                    $pushSubscription->setUser($user);
                }
            } else {
                Denkmal_Push_Subscription::create($subscriptionId, $endpoint, $user);
            }
        } else {
            if ($pushSubscription) {
                $pushSubscription->delete();
            }
        }
    }
}
