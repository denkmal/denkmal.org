<?php

class Denkmal_Push_Subscription extends \CM_Model_Abstract {

    /**
     * @return string
     */
    public function getEndpoint() {
        return $this->_get('endpoint');
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint) {
        $this->_set('endpoint', $endpoint);
    }

    /**
     * @return DateTime
     */
    public function getUpdated() {
        return $this->_get('updated');
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated) {
        $this->_set('updated', $updated);
    }

    /**
     * @return Denkmal_Model_User|null
     */
    public function getUser() {
        return $this->_get('user');
    }

    /**
     * @param Denkmal_Model_User|null $user
     */
    public function setUser(Denkmal_Model_User $user = null) {
        $this->_set('user', $user);
    }

    /**
     * @return Denkmal_Push_Notification_MessageList_Subscription
     */
    public function getMessageList() {
        return new Denkmal_Push_Notification_MessageList_Subscription($this);
    }

    /**
     * @return CM_Model_Schema_Definition
     */
    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'endpoint' => array('type' => 'string'),
            'updated'  => array('type' => 'DateTime'),
            'user'     => array('type' => 'Denkmal_Model_User', 'optional' => true),
        ));
    }

    protected function _onDeleteBefore() {
        /** @var Denkmal_Push_Notification_Message $message */
        foreach ($this->getMessageList() as $message) {
            $message->delete();
        }
    }

    protected function _getContainingCacheables() {
        return [
            new Denkmal_Push_SubscriptionList_All(),
        ];
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    /**
     * @param string             $endpoint
     * @param Denkmal_Model_User $user
     * @return \Denkmal_Push_Subscription
     */
    public static function create($endpoint, Denkmal_Model_User $user = null) {
        $pushSubscription = new Denkmal_Push_Subscription();
        $pushSubscription->setEndpoint($endpoint);
        $pushSubscription->setUpdated(new DateTime());
        $pushSubscription->setUser($user);
        $pushSubscription->commit();

        return $pushSubscription;
    }

    /**
     * @param string $endpoint
     * @return Denkmal_Push_Subscription|null
     */
    public static function findByEndpoint($endpoint) {
        $endpoint = (string) $endpoint;
        /** @var CM_Model_StorageAdapter_Database $persistence */
        $persistence = self::_getStorageAdapter(self::getPersistenceClass());

        $model = $persistence->findByData(self::getTypeStatic(), [
            'endpoint' => $endpoint,
        ]);

        if (null !== $model) {
            $model = new self($model['id']);
        }

        return $model;
    }
}
