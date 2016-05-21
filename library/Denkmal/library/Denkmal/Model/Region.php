<?php

class Denkmal_Model_Region extends CM_Model_Abstract {

    /**
     * @return string
     */
    public function getAbbreviation() {
        return $this->_get('abbreviation');
    }

    /**
     * @param string $abbreviation
     */
    public function setAbbreviation($abbreviation) {
        $this->_set('abbreviation', $abbreviation);
    }

    /**
     * @return CM_Model_Location
     */
    public function getLocation() {
        return new CM_Model_Location($this->_get('locationLevel'), $this->_get('locationId'));
    }

    /**
     * @param CM_Model_Location $location
     */
    public function setLocation(CM_Model_Location $location) {
        $this->_set('locationLevel', $location->getLevel());
        $this->_set('locationId', $location->getId());
    }

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
    public function getSlug() {
        return $this->_get('slug');
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->_set('slug', $slug);
    }

    //TODO timezone

    protected function _getSchema() {
        return new CM_Model_Schema_Definition([
            'name'          => ['type' => 'string'],
            'slug'          => ['type' => 'string'],
            'abbreviation'  => ['type' => 'string'],
            'locationLevel' => ['type' => 'int'],
            'locationId'    => ['type' => 'int'],
        ]);
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    /**
     * @param string            $name
     * @param string            $slug
     * @param string            $abbreviation
     * @param CM_Model_Location $location
     * @return Denkmal_Model_Region
     */
    public static function create($name, $slug, $abbreviation, CM_Model_Location $location) {
        $region = new self();
        $region->setName((string) $name);
        $region->setSlug((string) $slug);
        $region->setAbbreviation((string) $abbreviation);
        $region->setLocation($location);
        $region->commit();
        return $region;
    }
}
