<?php

class Denkmal_Push_Notification_Message extends \CM_Model_Abstract {

    /**
     * @return Denkmal_Push_Subscription
     */
    public function getSubscription() {
        return $this->_get('subscription');
    }

    /**
     * @param Denkmal_Push_Subscription $subscription
     */
    public function setSubscription(Denkmal_Push_Subscription $subscription) {
        $this->_set('subscription', $subscription);
    }

    /**
     * @return DateTime
     */
    public function getCreated() {
        return $this->_get('created');
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created) {
        $this->_set('created', $created);
    }

    /**
     * @return DateTime
     */
    public function getExpires() {
        return $this->_get('expires');
    }

    /**
     * @param DateTime $expires
     */
    public function setExpires($expires) {
        $this->_set('expires', $expires);
    }

    /**
     * @return array
     */
    public function getData() {
        return CM_Params::jsonDecode($this->_get('data'));
    }

    /**
     * @param array $data
     */
    public function setData(array $data) {
        $this->_set('data', CM_Params::jsonEncode($data));
    }

    /**
     * @return CM_Model_Schema_Definition
     */
    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'subscription' => array('type' => 'Denkmal_Push_Subscription'),
            'created'      => array('type' => 'DateTime'),
            'expires'      => array('type' => 'DateTime'),
            'data'         => array('type' => 'string'),
        ));
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    /**
     * @param Denkmal_Push_Subscription $subscription
     * @param DateTime                  $expires
     * @param array                     $data
     * @return Denkmal_Push_Notification_Message
     */
    public static function create(Denkmal_Push_Subscription $subscription, DateTime $expires, array $data) {
        $message = new Denkmal_Push_Notification_Message();
        $message->setSubscription($subscription);
        $message->setCreated(new DateTime());
        $message->setExpires($expires);
        $message->setData($data);
        $message->commit();

        return $message;
    }

    /**
     * @param string $endpoint
     * @return array
     * @throws CM_Exception_Invalid
     */
    public static function rpc_getListBySubscription($endpoint) {
        $subscription = Denkmal_Push_Subscription::findByEndpoint($endpoint);
        if (null === $subscription) {
            throw new CM_Exception_Invalid("Cannot find subscription with endpoint `{$endpoint}`.");
        }

        return Functional\map($subscription->getMessageList()->getItems(), function (Denkmal_Push_Notification_Message $message) {
            $data = $message->getData();
            $message->delete();
            return $data;
        });
    }
}
