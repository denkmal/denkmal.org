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
     * @return boolean
     */
    public function getSuspended() {
        return $this->_get('suspended');
    }

    /**
     * @param boolean $suspended
     */
    public function setSuspended($suspended) {
        $this->_set('suspended', $suspended);
    }

    /**
     * @return boolean
     */
    public function getSecret() {
        return $this->_get('secret');
    }

    /**
     * @param boolean $secret
     */
    public function setSecret($secret) {
        $this->_set('secret', $secret);
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

    /**
     * @return string|null
     */
    public function getTwitterUsername() {
        return $this->_get('twitterUsername');
    }

    /**
     * @param string|null $twitterUsername
     */
    public function setTwitterUsername($twitterUsername) {
        $this->_set('twitterUsername', $twitterUsername);
    }

    /**
     * @return Denkmal_Model_FacebookPage|null
     */
    public function getFacebookPage() {
        return $this->_get('facebookPage');
    }

    /**
     * @param Denkmal_Model_FacebookPage|null $facebookPage
     */
    public function setFacebookPage(Denkmal_Model_FacebookPage $facebookPage = null) {
        $this->_set('facebookPage', $facebookPage);
    }

    /**
     * @return Denkmal_Model_Region
     */
    public function getRegion() {
        return $this->_get('region');
    }

    /**
     * @param Denkmal_Model_Region $region
     */
    public function setRegion(Denkmal_Model_Region $region) {
        $this->_set('region', $region);
    }

    /**
     * @return DateTimeZone
     */
    public function getTimeZone() {
        return $this->getRegion()->getTimeZone();
    }

    public function toArrayApi(CM_Frontend_Render $render) {
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
        $cacheables[] = new Denkmal_Paging_Venue_All(null, true);
        $cacheables[] = new Denkmal_Paging_Venue_All(null, false);
        $cacheables[] = new Denkmal_Paging_Venue_All($this->getRegion(), true);
        $cacheables[] = new Denkmal_Paging_Venue_All($this->getRegion(), false);
        return $cacheables;
    }

    protected function _onChange() {
        $this->_changeContainingCacheables();
    }

    /**
     * @param Denkmal_Model_Region $region
     * @param string               $name
     * @return Denkmal_Model_Venue|null
     */
    public static function findByName(Denkmal_Model_Region $region, $name) {
        $name = (string) $name;
        $where = ['region' => $region->getId(), 'name' => $name];
        $venueId = CM_Db_Db::select('denkmal_model_venue', 'id', $where)->fetchColumn();
        if (!$venueId) {
            return null;
        }
        return new self($venueId);
    }

    /**
     * @param Denkmal_Model_Region $region
     * @param string               $name
     * @return Denkmal_Model_Venue|null
     */
    public static function findByNameOrAlias(Denkmal_Model_Region $region, $name) {
        if ($venue = self::findByName($region, $name)) {
            return $venue;
        }
        if ($venueAlias = Denkmal_Model_VenueAlias::findByName($region, $name)) {
            return $venueAlias->getVenue();
        }
        return null;
    }

    /**
     * @param string               $name
     * @param boolean              $queued
     * @param boolean              $ignore
     * @param Denkmal_Model_Region $region
     * @param string|null          $url
     * @param string|null          $address
     * @param CM_Geo_Point|null    $coordinates
     * @return Denkmal_Model_Venue
     * @throws CM_Exception_Invalid
     * @throws CM_Exception_NotImplemented
     */
    public static function create($name, $queued, $ignore, Denkmal_Model_Region $region, $url = null, $address = null, CM_Geo_Point $coordinates = null) {
        $venue = new self();
        $venue->setName($name);
        $venue->setUrl($url);
        $venue->setAddress($address);
        $venue->setCoordinates($coordinates);
        $venue->setQueued($queued);
        $venue->setIgnore($ignore);
        $venue->setRegion($region);
        $venue->setSuspended(false);
        $venue->setSecret(false);
        $venue->setEmail(null);
        $venue->setTwitterUsername(null);
        $venue->setFacebookPage(null);
        $venue->commit();
        return $venue;
    }

    protected function _onDeleteBefore() {
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
            'name'            => array('type' => 'string'),
            'url'             => array('type' => 'string', 'optional' => true),
            'address'         => array('type' => 'string', 'optional' => true),
            'latitude'        => array('type' => 'float', 'optional' => true),
            'longitude'       => array('type' => 'float', 'optional' => true),
            'queued'          => array('type' => 'boolean'),
            'ignore'          => array('type' => 'boolean'),
            'suspended'       => array('type' => 'boolean'),
            'secret'          => array('type' => 'boolean'),
            'email'           => array('type' => 'string', 'optional' => true),
            'twitterUsername' => array('type' => 'string', 'optional' => true),
            'facebookPage'    => array('type' => 'Denkmal_Model_FacebookPage', 'optional' => true),
            'region'          => array('type' => 'Denkmal_Model_Region'),
        ));
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
