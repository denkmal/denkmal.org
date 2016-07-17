<?php

class Denkmal_Component_PushNotifications extends \Denkmal_Component_Abstract {

    public function prepare(\CM_Frontend_Environment $environment, \CM_Frontend_ViewResponse $viewResponse) {
        $autoSubscribe = $this->_params->getBoolean('autoSubscribe', false);

        $viewResponse->getJs()->setProperty('autoSubscribe', $autoSubscribe);
    }

    public function ajax_storePushSubscription(CM_Params $params, CM_Frontend_JavascriptContainer_View $handler, CM_Http_Response_View_Ajax $response) {
        $state = $params->getBoolean('state');
        $endpoint = $params->getString('endpoint');
        $site = $response->getSite();
        $user = $params->has('user') ? $params->getUser('user') : null;

        if (!Denkmal_Push_Notification_Provider_Abstract::hasEndpoint($response->getServiceManager(), $endpoint)) {
            throw new CM_Exception("Unknown notification endpoint `{$endpoint}`.");
        }

        $pushSubscription = Denkmal_Push_Subscription::findByEndpoint($endpoint);

        if ($state) {
            if ($pushSubscription) {
                $pushSubscription->setUpdated(new DateTime());
                $pushSubscription->setSite($site);
                if ($user) {
                    $pushSubscription->setUser($user);
                }
            } else {
                Denkmal_Push_Subscription::create($endpoint, $site, $user);
            }
        } else {
            if ($pushSubscription) {
                $pushSubscription->delete();
            }
        }
    }
}
