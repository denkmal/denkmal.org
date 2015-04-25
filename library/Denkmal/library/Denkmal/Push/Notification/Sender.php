<?php

class Denkmal_Push_Notification_Sender implements CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    /** @var Denkmal_Push_ClientConfiguration */
    private $_clientConfig;

    /**
     * @param array $clientConfig
     */
    public function __construct(array $clientConfig) {
        $this->_clientConfig = new Denkmal_Push_ClientConfiguration($clientConfig);
    }

    /**
     * @param Denkmal_Push_Subscription[]       $subscriptionList
     * @param Denkmal_Push_Notification_Message $message
     */
    public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        foreach ($subscriptionList as $subscription) {
            Denkmal_Push_Notification_Message::create($subscription, $message->getExpires(), $message->getData());
        }

        $subscriptionListGrouped = Functional\group($subscriptionList, function (Denkmal_Push_Subscription $subscription) {
            return $subscription->getEndpoint();
        });

        foreach ($subscriptionListGrouped as $endpoint => $subscriptionListForEndpoint) {
            $this->_getProvider($endpoint)->sendNotifications(array_values($subscriptionListForEndpoint), $message);
        }
    }

    /**
     * @return Denkmal_Push_ClientConfiguration
     */
    public function getClientConfig() {
        return $this->_clientConfig;
    }

    /**
     * @param string $endpoint
     * @return Denkmal_Push_Notification_Provider_Abstract
     */
    protected function _getProvider($endpoint) {
        return Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), $endpoint);
    }
}
