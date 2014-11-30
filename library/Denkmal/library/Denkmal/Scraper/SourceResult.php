<?php

class Denkmal_Scraper_SourceResult extends CM_Model_Abstract {

    /**
     * @return Denkmal_Scraper_Source_Abstract
     */
    public function getScraperSource() {
        $sourceType = $this->_get('sourceType');
        return Denkmal_Scraper_Source_Abstract::factoryByType($sourceType);
    }

    /**
     * @param Denkmal_Scraper_Source_Abstract $source
     */
    public function setScraperSource(Denkmal_Scraper_Source_Abstract $source) {
        $this->_set('sourceType', $source->getType());
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
    public function setCreated(DateTime $created) {
        $this->_set('created', $created);
    }

    /**
     * @return int
     */
    public function getEventDataCount() {
        return $this->_get('eventDataCount');
    }

    /**
     * @param int $eventDataCount
     */
    public function setEventDataCount($eventDataCount) {
        $this->_set('eventDataCount', $eventDataCount);
    }

    /**
     * @return string|null
     */
    public function getError() {
        return $this->_get('error');
    }

    /**
     * @param string|null $error
     */
    public function setError($error) {
        $this->_set('error', $error);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'sourceType'     => array('type' => 'int'),
            'created'        => array('type' => 'DateTime'),
            'eventDataCount' => array('type' => 'int'),
            'error'          => array('type' => 'string', 'optional' => true),
        ));
    }

    /**
     * @param Denkmal_Scraper_Source_Abstract $source
     * @param DateTime                        $created
     * @param int                             $eventDataCount
     * @param string|null                     $error
     * @return Denkmal_Scraper_SourceResult
     */
    public static function create(Denkmal_Scraper_Source_Abstract $source, DateTime $created, $eventDataCount, $error = null) {
        $sourceResult = new self();
        $sourceResult->setScraperSource($source);
        $sourceResult->setCreated($created);
        $sourceResult->setEventDataCount($eventDataCount);
        $sourceResult->setError($error);
        $sourceResult->commit();
        return $sourceResult;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
