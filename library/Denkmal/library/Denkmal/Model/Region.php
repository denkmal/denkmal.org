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

    /**
     * @return Denkmal_Twitter_Credentials|null
     */
    public function getTwitterCredentials() {
        return $this->_get('twitterCredentials');
    }

    /**
     * @param Denkmal_Twitter_Credentials|null $credentials
     */
    public function setTwitterCredentials(Denkmal_Twitter_Credentials $credentials = null) {
        $this->_set('twitterCredentials', $credentials);
    }

    /**
     * @return string|null
     */
    public function getTwitterAccount() {
        return $this->_get('twitterAccount');
    }

    /**
     * @param string|null $twitterAccount
     */
    public function setTwitterAccount($twitterAccount = null) {
        $this->_set('twitterAccount', $twitterAccount);
    }

    /**
     * @return string|null
     */
    public function getFacebookAccount() {
        return $this->_get('facebookAccount');
    }

    /**
     * @param string|null $facebookAccount
     */
    public function setFacebookAccount($facebookAccount = null) {
        $this->_set('facebookAccount', $facebookAccount);
    }

    /**
     * @return string
     */
    public function getEmailAddress() {
        return $this->_get('emailAddress');
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress) {
        $this->_set('emailAddress', $emailAddress);
    }

    /**
     * @return Denkmal_Suspension
     */
    public function getSuspension() {
        /** @var DateTime|null $suspensionUntil */
        $suspensionUntil = $this->_get('suspensionUntil');
        return new Denkmal_Suspension($suspensionUntil);
    }

    /**
     * @param DateTime|null $until
     */
    public function setSuspension(DateTime $until = null) {
        $this->_set('suspensionUntil', $until);
    }

    /**
     * @return DateTimeZone
     * @throws CM_Exception
     */
    public function getTimeZone() {
        $timeZone = $this->getLocation()->getTimeZone();
        if (null === $timeZone) {
            throw new CM_Exception('Region\'s location is missing timezone');
        }
        return $timeZone;
    }

    /**
     * @return Denkmal_Paging_Message_Region
     */
    public function getMessageList() {
        return new Denkmal_Paging_Message_Region($this);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition([
            'name'               => ['type' => 'string'],
            'slug'               => ['type' => 'string'],
            'abbreviation'       => ['type' => 'string'],
            'locationLevel'      => ['type' => 'int'],
            'locationId'         => ['type' => 'int'],
            'emailAddress'       => ['type' => 'string'],
            'twitterCredentials' => ['type' => 'Denkmal_Twitter_Credentials', 'optional' => true],
            'twitterAccount'     => ['type' => 'string', 'optional' => true],
            'facebookAccount'    => ['type' => 'string', 'optional' => true],
            'suspensionUntil'    => ['type' => 'DateTime', 'optional' => true],
        ]);
    }

    protected function _getContainingCacheables() {
        $cacheables = parent::_getContainingCacheables();
        $cacheables[] = new Denkmal_Paging_Region_All();
        return $cacheables;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    /**
     * @param string            $name
     * @param string            $slug
     * @param string            $abbreviation
     * @param string            $emailAddress
     * @param CM_Model_Location $location
     * @return Denkmal_Model_Region
     * @throws CM_Exception_Invalid
     * @throws CM_Exception_NotImplemented
     */
    public static function create($name, $slug, $abbreviation, $emailAddress, CM_Model_Location $location) {
        $region = new self();
        $region->setName((string) $name);
        $region->setSlug((string) $slug);
        $region->setAbbreviation((string) $abbreviation);
        $region->setLocation($location);
        $region->setEmailAddress((string) $emailAddress);
        $region->setTwitterCredentials(null);
        $region->setTwitterAccount(null);
        $region->setFacebookAccount(null);
        $region->setSuspension(null);
        $region->commit();
        return $region;
    }

    /**
     * @param string $slug
     * @return Denkmal_Model_Region|null
     */
    public static function findBySlug($slug) {
        $slug = (string) $slug;
        $cache = CM_Cache_Local::getInstance();
        $regionId = $cache->get($cache->key(__METHOD__, $slug), function () use ($slug) {
            return CM_Db_Db::select('denkmal_model_region', 'id', ['slug' => $slug])->fetchColumn();
        });
        if (!$regionId) {
            return null;
        }
        return new self($regionId);
    }

    /**
     * @param string $slug
     * @return Denkmal_Model_Region
     * @throws CM_Exception_Nonexistent
     */
    public static function getBySlug($slug) {
        $slug = (string) $slug;
        $region = self::findBySlug($slug);
        if (null === $region) {
            throw new CM_Exception_Nonexistent('Region with slug `' . $slug . '` does not exist');
        }
        return $region;
    }
}
