<?php

abstract class Denkmal_Push_Notification_Provider_Abstract implements CM_Service_ManagerAwareInterface {

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
    abstract public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message);

    /**
     * @return string
     */
    abstract public function getIdentifier();

    /**
     * @param CM_Service_Manager $serviceManager
     * @param string             $endpoint
     * @return boolean
     */
    public static function hasEndpoint(CM_Service_Manager $serviceManager, $endpoint) {
        return (null !== self::findByEndpoint($serviceManager, $endpoint));
    }

    /**
     * @param CM_Service_Manager $serviceManager
     * @param string             $endpoint
     * @return Denkmal_Push_Notification_Provider_Abstract|null
     */
    public static function findByEndpoint(CM_Service_Manager $serviceManager, $endpoint) {
        if (0 === strpos($endpoint, 'https://android.googleapis.com/gcm/send')) {
            return new Denkmal_Push_Notification_Provider_GoogleCloudMessaging($serviceManager);
        }
        if (0 === strpos($endpoint, 'https://updates.push.services.mozilla.com/push')) {
            return new Denkmal_Push_Notification_Provider_WebPush($serviceManager);
        }
        return null;
    }

    /**
     * @param CM_Service_Manager $serviceManager
     * @param string             $endpoint
     * @throws CM_Exception
     * @return Denkmal_Push_Notification_Provider_Abstract
     */
    public static function factoryByEndpoint(CM_Service_Manager $serviceManager, $endpoint) {
        $provider = self::findByEndpoint($serviceManager, $endpoint);
        if (null === $provider) {
            throw new CM_Exception("No provider for endpoint `{$endpoint}`.");
        }
        return $provider;
    }
}
