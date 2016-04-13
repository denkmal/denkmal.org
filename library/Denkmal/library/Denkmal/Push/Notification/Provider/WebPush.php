<?php

class Denkmal_Push_Notification_Provider_WebPush extends Denkmal_Push_Notification_Provider_Abstract {

    public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        $ttl = max(0, $message->getExpires()->getTimestamp() - (new DateTime())->getTimestamp());

        $messageFactory = new \GuzzleHttp\Message\MessageFactory();
        $requests = Functional\map($subscriptionList, function (Denkmal_Push_Subscription $subscription) use ($messageFactory, $ttl) {
            $headers = [
                'TTL' => $ttl,
            ];
            return $messageFactory->createRequest('POST', $subscription->getEndpoint(), ['headers' => $headers]);
        });
        $this->_sendRequests($requests);
    }

    public function getIdentifier() {
        return 'web-push';
    }

    /**
     * @param \GuzzleHttp\Message\Request[] $requests
     * @throws CM_Exception
     */
    protected function _sendRequests(array $requests) {
        $guzzle = $this->_getGuzzleClient();
        /** @var \GuzzleHttp\Event\ErrorEvent[] $errorEvents */
        $errorEvents = [];
        $pool = new \GuzzleHttp\Pool($guzzle, $requests, [
            'pool_size' => 100,
            'error'     => function (\GuzzleHttp\Event\ErrorEvent $errorEvent) use (&$errorEvents) {
                $errorEvents[] = $errorEvent;
            },
        ]);
        $pool->wait();
        if (!empty($errorEvents)) {
            /** @var \GuzzleHttp\Event\ErrorEvent $firstError */
            $firstError = Functional\first($errorEvents);
            throw new CM_Exception(count($errorEvents) . '/' . count($requests) . ' requests failed.', null, [
                'url'     => $firstError->getRequest()->getUrl(),
                'message' => $firstError->getException()->getMessage(),
            ]);
        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function _getGuzzleClient() {
        return new \GuzzleHttp\Client();
    }
}
