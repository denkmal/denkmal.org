<?php

class Denkmal_Model_Venue extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

    /**
     * @return Denkmal_Paging_Event_Venue
     */
    public function getEventList() {
        return new Denkmal_Paging_Event_Venue($this);
    }

    /**
     * @return Denkmal_Paging_VenueAlias_Venue
     */
    public function getAliasList() {
        return new Denkmal_Paging_VenueAlias_Venue($this);
    }

    /**
     * @return Denkmal_Paging_Message_Venue
     */
    public function getMessageList() {
        return new Denkmal_Paging_Message_Venue($this);
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
     * @return string|null
     */
    public function getUrl() {
        return $this->_get('url');
    }

    /**
     * @param string|null $url
     */
    public function setUrl($url) {
        $this->_set('url', $url);
    }

    /**
     * @return string|null
     */
    public function getAddress() {
        return $this->_get('address');
    }

    /**
     * @param string|null $address
     */
    public function setAddress($address) {
        $this->_set('address', $address);
    }

    /**
     * @return CM_Geo_Point|null
     */
    public function getCoordinates() {
        $latitude = $this->_get('latitude');
        $longitude = $this->_get('longitude');
        if (null === $latitude || null === $longitude) {
            return null;
        }
        return new CM_Geo_Point($latitude, $longitude);
    }

    /**
     * @param CM_Geo_Point|null $coordinates
     */
    public function setCoordinates(CM_Geo_Point $coordinates = null) {
        $latitude = $coordinates ? $coordinates->getLatitude() : null;
        $longitude = $coordinates ? $coordinates->getLongitude() : null;
        $this->_set('latitude', $latitude);
        $this->_set('longitude', $longitude);
    }

    /**
     * @return boolean
     */
    public function getQueued() {
        return $this->_get('queued');
    }

    /**
     * @param boolean $queued
     */
    public function setQueued($queued) {
        $this->_set('queued', $queued);
    }

    /**
     * @return boolean
     */
    public function getIgnore() {
        return $this->_get('ignore');
    }

    /**
     * @param boolean $ignore
     */
    public function setIgnore($ignore) {
        $this->_set('ignore', $ignore);
    }

    /**
     * @return string|null
     */
    public function getEmail() {
        return $this->_get('email');
    }

    /**
     * @param string|null $email
     */
    public function setEmail($email) {
        $this->_set('email', $email);
    }

    public function toArrayApi(CM_Render $render) {
        $array = array();
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        if ($url = $this->getUrl()) {
            $array['url'] = $url;
        }
        if ($address = $this->getAddress()) {
            $array['address'] = $address;
        }
        if ($coordinates = $this->getCoordinates()) {
            $array['latitude'] = $coordinates->getLatitude();
            $array['longitude'] = $coordinates->getLongitude();
        }
        return $array;
    }

    protected function _getContainingCacheables() {
        $cacheables = parent::_getContainingCacheables();
        $cacheables[] = new Denkmal_Paging_Venue_All();
        return $cacheables;
    }

    protected function _onChange() {
        $list = new Denkmal_Paging_Venue_All();
        $list->_change();
    }

    /**
     * @param string $name
     * @return Denkmal_Model_Venue|null
     */
    public static function findByName($name) {
        $name = (string) $name;
        $venueId = CM_Db_Db::select('denkmal_model_venue', 'id', array('name' => $name))->fetchColumn();
        if (!$venueId) {
            return null;
        }
        return new self($venueId);
    }

    /**
     * @param string $name
     * @return Denkmal_Model_Venue|null
     */
    public static function findByNameOrAlias($name) {
        if ($venue = self::findByName($name)) {
            return $venue;
        }
        if ($venueAlias = Denkmal_Model_VenueAlias::findByName($name)) {
            return $venueAlias->getVenue();
        }
        return null;
    }

    /**
     * @param string            $name
     * @param boolean           $queued
     * @param boolean           $ignore
     * @param string|null       $url
     * @param string|null       $address
     * @param CM_Geo_Point|null $coordinates
     * @return Denkmal_Model_Venue
     */
    public static function create($name, $queued, $ignore, $url = null, $address = null, CM_Geo_Point $coordinates = null) {
        $venue = new self();
        $venue->setName($name);
        $venue->setUrl($url);
        $venue->setAddress($address);
        $venue->setCoordinates($coordinates);
        $venue->setQueued($queued);
        $venue->setIgnore($ignore);
        $venue->setEmail(null);
        $venue->commit();
        return $venue;
    }

    protected function _onDelete() {
        /** @var Denkmal_Model_Event $event */
        foreach ($this->getEventList() as $event) {
            $event->delete();
        }
        /** @var Denkmal_Model_VenueAlias $alias */
        foreach ($this->getAliasList() as $alias) {
            $alias->delete();
        }
        /** @var Denkmal_Model_Message $message */
        foreach ($this->getMessageList() as $message) {
            $message->delete();
        }
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'name'      => array('type' => 'string'),
            'url'       => array('type' => 'string', 'optional' => true),
            'address'   => array('type' => 'string', 'optional' => true),
            'latitude'  => array('type' => 'float', 'optional' => true),
            'longitude' => array('type' => 'float', 'optional' => true),
            'queued'    => array('type' => 'boolean'),
            'ignore'    => array('type' => 'boolean'),
            'email'     => array('type' => 'string', 'optional' => true),
        ));
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
