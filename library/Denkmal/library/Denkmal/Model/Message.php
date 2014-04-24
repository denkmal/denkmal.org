<?php

class Denkmal_Model_Message extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

    /**
     * @param DateTime $timestamp
     */
    public function setCreated($timestamp) {
        $this->_set('created', $timestamp);
    }

    /**
     * @return DateTime
     */
    public function getCreated() {
        return $this->_get('created');
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        $this->_set('text', $text);
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->_get('text');
    }

    /**
     * @param Denkmal_Model_Venue $venue
     */
    public function setVenue($venue) {
        $this->_set('venue', $venue);
    }

    /**
     * @return Denkmal_Model_Venue
     */
    public function getVenue() {
        return $this->_get('venue');
    }

    public function toArrayApi(CM_Render $render) {
        $array = array();
        $array['id'] = $this->getId();
        $array['venue'] = $this->getVenue()->getId();
        $array['created'] = $this->getCreated()->getTimestamp();
        $array['text'] = $this->getText();
        return $array;
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'venue'   => array('type' => 'Denkmal_Model_Venue'),
            'text'    => array('type' => 'string'),
            'created' => array('type' => 'DateTime'),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        $containingCacheables[] = new Denkmal_Paging_Message_All();
        return $containingCacheables;
    }

    /**
     * @param Denkmal_Model_Venue $venue
     * @param string              $text
     * @param DateTime|null       $created
     * @return Denkmal_Model_Message
     */
    public static function create(Denkmal_Model_Venue $venue, $text, DateTime $created = null) {
        if (null === $created) {
            $created = new DateTime();
        }

        $message = new self();
        $message->setVenue($venue);
        $message->setText($text);
        $message->setCreated($created);
        $message->commit();

        return $message;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
