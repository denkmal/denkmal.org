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

        $providerSubscriptionMap = [];
        foreach ($subscriptionList as $subscription) {
            $provider = $this->_getProvider($subscription);
            $providerId = $provider->getIdentifier();
            if (!isset($providerSubscriptionMap[$providerId])) {
                $providerSubscriptionMap[$providerId] = ['provider' => $provider, 'subscriptionList' => []];
            }
            $providerSubscriptionMap[$providerId]['subscriptionList'][] = $subscription;
        }

        foreach ($providerSubscriptionMap as $providerSubscriptionData) {
            /** @var Denkmal_Push_Notification_Provider_Abstract $provider */
            $provider = $providerSubscriptionData['provider'];
            /** @var Denkmal_Push_Subscription[] $subscriptionList */
            $subscriptionList = $providerSubscriptionData['subscriptionList'];

            $provider->sendNotifications($subscriptionList, $message);
        }
    }

    /**
     * @return Denkmal_Push_ClientConfiguration
     */
    public function getClientConfig() {
        return $this->_clientConfig;
    }

    /**
     * @param Denkmal_Push_Subscription $subscription
     * @return Denkmal_Push_Notification_Provider_Abstract
     */
    protected function _getProvider(Denkmal_Push_Subscription $subscription) {
        return Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), $subscription->getEndpoint());
    }
}
