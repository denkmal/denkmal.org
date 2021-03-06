<?php

class Denkmal_Push_Notification_Provider_GoogleCloudMessaging extends Denkmal_Push_Notification_Provider_Abstract {

    public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        $chunkList = array_chunk($subscriptionList, 1000);
        foreach ($chunkList as $subscriptionList) {
            $this->_sendNotifications($subscriptionList, $message);
        }
    }

    public function getIdentifier() {
        return 'google-cloud-messaging';
    }

    /**
     * @param Denkmal_Push_Subscription[]       $subscriptionList
     * @param Denkmal_Push_Notification_Message $message
     */
    protected function _sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        /** @var Denkmal_Push_Subscription[] $subscriptionMap */
        $subscriptionMap = [];
        foreach ($subscriptionList as $subscription) {
            $subscriptionMap[$this->_extractRegistrationId($subscription)] = $subscription;
        }

        $ttl = max(0, $message->getExpires()->getTimestamp() - (new DateTime())->getTimestamp());
        $gcmMessage = new \CodeMonkeysRu\GCM\Message(array_keys($subscriptionMap), $message->getData());
        $gcmMessage->setTtl($ttl);
        $response = $this->_getSender()->send($gcmMessage);

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

    /**
     * @param Denkmal_Push_Subscription $subscription
     * @return string
     */
    protected function _extractRegistrationId(Denkmal_Push_Subscription $subscription) {
        $endpointParts = preg_split('#/#', $subscription->getEndpoint());
        return (string) $endpointParts[count($endpointParts) - 1];
    }
}
