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
     * @param CM_Service_Manager $serviceManager
     * @param string             $endpoint
     * @throws CM_Exception
     * @return Denkmal_Push_Notification_Provider_Abstract
     */
    public static function factoryByEndpoint(CM_Service_Manager $serviceManager, $endpoint) {
        switch ($endpoint) {
            case 'https://android.googleapis.com/gcm/send':
                return new Denkmal_Push_Notification_Provider_GoogleCloudMessaging($serviceManager);
                break;
            default:
                throw new CM_Exception("Unknown notification endpoint `{$endpoint}`.");
                break;
        }
    }
}
