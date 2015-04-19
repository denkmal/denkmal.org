<?php

class Denkmal_Push_Notification_Sender implements CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    /**
     * @param CM_Service_Manager $serviceManager
     */
    public function __construct(CM_Service_Manager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }

    /**
     * @param Denkmal_Push_Subscription[]       $subscriptionList
     * @param Denkmal_Push_Notification_Message $message
     */
    public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        $subscriptionListGrouped = Functional\group($subscriptionList, function (Denkmal_Push_Subscription $subscription) {
            return $subscription->getEndpoint();
        });

        foreach ($subscriptionListGrouped as $endpoint => $subscriptionListForEndpoint) {
            $this->_getProvider($endpoint)->sendNotifications(array_values($subscriptionListForEndpoint), $message);
        }
    }

    /**
     * @param string $endpoint
     * @return Denkmal_Push_Notification_Provider_Abstract
     */
    protected function _getProvider($endpoint) {
        return Denkmal_Push_Notification_Provider_Abstract::factoryByEndpoint($this->getServiceManager(), $endpoint);
    }
}
