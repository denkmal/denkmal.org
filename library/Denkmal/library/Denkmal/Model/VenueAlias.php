<?php

class Denkmal_Model_VenueAlias extends CM_Model_Abstract {

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
     * @return Denkmal_Model_Venue
     */
    public function getVenue() {
        return $this->_get('venue');
    }

    /**
     * @param Denkmal_Model_Venue $venue
     */
    public function setVenue(Denkmal_Model_Venue $venue) {
        $this->_set('venue', $venue);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'name'  => array('type' => 'string'),
            'venue' => array('type' => 'Denkmal_Model_Venue'),
        ));
    }

    /**
     * @param Denkmal_Model_Venue $venue
     * @param string              $name
     * @return Denkmal_Model_VenueAlias
     */
    public static function create(Denkmal_Model_Venue $venue, $name) {
        $venueAlias = new self();
        $venueAlias->setVenue($venue);
        $venueAlias->setName($name);
        $venueAlias->commit();
        return $venueAlias;
    }

    /**
     * @param Denkmal_Model_Region $region
     * @param string               $name
     * @return Denkmal_Model_VenueAlias|null
     */
    public static function findByName(Denkmal_Model_Region $region, $name) {
        $name = (string) $name;
        $query = '
            SELECT alias.id FROM denkmal_model_venuealias alias
            JOIN denkmal_model_venue venue ON(venue.id = alias.venue)
            WHERE venue.region = ? AND alias.name = ?
        ';
        $venueAliasId = CM_Db_Db::exec($query, [$region->getId(), $name])->fetchColumn();
        if (!$venueAliasId) {
            return null;
        }
        return new self($venueAliasId);
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
