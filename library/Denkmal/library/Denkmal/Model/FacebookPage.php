<?php

class Denkmal_Model_FacebookPage extends CM_Model_Abstract {

    /**
     * @return string
     */
    public function getName() {
        return $this->_get('name');
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->_set('name', $name);
    }

    /**
     * @return string
     */
    public function getFacebookId() {
        return $this->_get('facebookId');
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId($facebookId) {
        $this->_set('facebookId', $facebookId);
    }

    /**
     * @return int
     */
    public function getFailedCount() {
        return $this->_get('failedCount');
    }

    /**
     * @param int $failedCount
     */
    public function setFailedCount($failedCount) {
        $this->_set('failedCount', $failedCount);
    }

    /**
     * @return string
     */
    public function getUrl() {
        return 'https://www.facebook.com/' . $this->getFacebookId();
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'name'        => ['type' => 'string'],
            'facebookId'  => ['type' => 'string'],
            'failedCount' => ['type' => 'int'],
        ));
    }

    /**
     * @param string $facebookId
     * @return Denkmal_Model_FacebookPage|null
     */
    public static function findByFacebookId($facebookId) {
        $facebookId = (string) $facebookId;
        $id = CM_Db_Db::select('denkmal_model_facebookpage', 'id', ['facebookId' => $facebookId])->fetchColumn();
        if (!$id) {
            return null;
        }
        return new self($id);
    }

    /**
     * @param string $facebookId
     * @param string $name
     * @return Denkmal_Model_FacebookPage
     */
    public static function create($facebookId, $name) {
        $model = new self();
        $model->setFacebookId($facebookId);
        $model->setName($name);
        $model->setFailedCount(0);
        $model->commit();
        return $model;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
