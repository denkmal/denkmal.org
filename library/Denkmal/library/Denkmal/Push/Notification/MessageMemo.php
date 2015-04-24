<?php

class Denkmal_Push_Notification_MessageMemo extends \CM_Model_Abstract {

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
     * @return Denkmal_Push_Notification_MessageMemo
     */
    public static function create(Denkmal_Push_Subscription $subscription, DateTime $expires, array $data) {
        $messageMemo = new Denkmal_Push_Notification_MessageMemo();
        $messageMemo->setSubscription($subscription);
        $messageMemo->setCreated(new DateTime());
        $messageMemo->setExpires($expires);
        $messageMemo->setData($data);
        $messageMemo->commit();

        return $messageMemo;
    }
}
