<?php

use Psr\Http\Message\RequestInterface;

class Denkmal_Push_Notification_Provider_WebPush extends Denkmal_Push_Notification_Provider_Abstract {

    public function sendNotifications(array $subscriptionList, Denkmal_Push_Notification_Message $message) {
        $ttl = max(0, $message->getExpires()->getTimestamp() - (new DateTime())->getTimestamp());

        $requests = Functional\map($subscriptionList, function (Denkmal_Push_Subscription $subscription) use ($ttl) {
            $headers = [
                'TTL' => $ttl,
            ];
            return new GuzzleHttp\Psr7\Request('POST', $subscription->getEndpoint(), $headers);
        });
        $this->_sendRequests($requests);
    }

    public function getIdentifier() {
        return 'web-push';
    }

    /**
     * @param RequestInterface[] $requests
     * @throws CM_Exception
     */
    protected function _sendRequests(array $requests) {
        $guzzle = $this->_getGuzzleClient();
        /** @var GuzzleHttp\Exception\RequestException[] $errors */
        $errors = [];
        $pool = new GuzzleHttp\Pool($guzzle, $requests, [
            'concurrency' => 100,
            'rejected'    => function (GuzzleHttp\Exception\RequestException $error) use (&$errors) {
                $errors[] = $error;
            },
        ]);
        $pool->promise()->wait();

        if (!empty($errors)) {
            /** @var GuzzleHttp\Exception\RequestException $firstError */
            $firstError = Functional\first($errors);
            throw new CM_Exception(count($errors) . '/' . count($requests) . ' requests failed.', null, [
                'url'     => $firstError->getRequest()->getUri()->__toString(),
                'message' => $firstError->getMessage(),
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
