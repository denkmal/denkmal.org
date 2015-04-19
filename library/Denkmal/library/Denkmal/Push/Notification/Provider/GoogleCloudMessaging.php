<?php

class Denkmal_Push_Notification_Provider_GoogleCloudMessaging extends Denkmal_Push_Notification_Provider_Abstract {

    public function sendNotifications(array $subscriptionList, array $data) {
        $chunkList = array_chunk($subscriptionList, 1000);
        foreach ($chunkList as $subscriptionList) {
            $this->_sendNotifications($subscriptionList, $data);
        }
    }

    /**
     * @param Denkmal_Push_Subscription[] $subscriptionList
     * @param array                       $data
     */
    protected function _sendNotifications(array $subscriptionList, array $data) {
        /** @var Denkmal_Push_Subscription[] $subscriptionMap */
        $subscriptionMap = [];
        foreach ($subscriptionList as $subscription) {
            $subscriptionMap[$subscription->getSubscriptionId()] = $subscription;
        }

        $message = new \CodeMonkeysRu\GCM\Message(array_keys($subscriptionMap), $data);
        $message->setTtl(3600 * 6);
        $response = $this->_getSender()->send($message);

        if ($response->getNewRegistrationIdsCount() > 0) {
            foreach ($response->getNewRegistrationIds() as $oldRegistrationId => $newRegistrationId) {
                $subscription = $subscriptionMap[$oldRegistrationId];
                $subscription->setSubscriptionId($newRegistrationId);
            }
        }

        if ($response->getFailureCount() > 0) {
            foreach ($response->getInvalidRegistrationIds() as $invalidRegistrationId) {
                $subscription = $subscriptionMap[$invalidRegistrationId];
                $subscription->delete();
            }
        }
    }

    /**
     * @return \CodeMonkeysRu\GCM\Sender
     */
    protected function _getSender() {
        return $this->getServiceManager()->get('google-cloud-messaging', '\CodeMonkeysRu\GCM\Sender');
    }
}
