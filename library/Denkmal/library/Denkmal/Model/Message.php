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
     * @param string|null $text
     */
    public function setText($text = null) {
        $this->_set('text', $text);
    }

    /**
     * @return string|null
     */
    public function getText() {
        return $this->_get('text');
    }

    /**
     * @return bool
     */
    public function hasText() {
        return null !== $this->_get('text');
    }

    /**
     * @param Denkmal_Model_MessageImage|null $image
     */
    public function setImage(Denkmal_Model_MessageImage $image = null) {
        $this->_set('image', $image);
    }

    /**
     * @return Denkmal_Model_MessageImage|null
     */
    public function getImage() {
        return $this->_get('image');
    }

    /**
     * @return bool
     */
    public function hasImage() {
        return null !== $this->_get('image');
    }

    /**
     * @param Denkmal_Model_Venue $venue
     */
    public function setVenue($venue) {
        if ($this->hasIdRaw()) {
            $messageListOld = new Denkmal_Paging_Message_Venue($this->getVenue());
            $messageListOld->_change();
        }

        $this->_set('venue', $venue);

        if ($this->hasIdRaw()) {
            $messageListNew = new Denkmal_Paging_Message_Venue($this->getVenue());
            $messageListNew->_change();
        }
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
        $array['image'] = $this->hasImage() ? $this->getImage()->toArrayApi($render) : null;
        return $array;
    }

    protected function _onDelete() {
        if ($image = $this->getImage()) {
            $this->setImage(null);
            $image->delete();
        }
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'venue'   => array('type' => 'Denkmal_Model_Venue'),
            'text'    => array('type' => 'string', 'optional' => true),
            'created' => array('type' => 'DateTime'),
            'image'   => array('type' => 'Denkmal_Model_MessageImage', 'optional' => true),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        $containingCacheables[] = new Denkmal_Paging_Message_All();
        $containingCacheables[] = new Denkmal_Paging_Message_Venue($this->getVenue());
        return $containingCacheables;
    }

    /**
     * @param Denkmal_Model_Venue             $venue
     * @param string|null                     $text
     * @param Denkmal_Model_MessageImage|null $image
     * @param DateTime|null                   $created
     * @return Denkmal_Model_Message
     */
    public static function create(Denkmal_Model_Venue $venue, $text = null, Denkmal_Model_MessageImage $image = null, DateTime $created = null) {
        if (null === $created) {
            $created = new DateTime();
        }

        $message = new self();
        $message->setVenue($venue);
        $message->setText($text);
        $message->setCreated($created);
        $message->setImage($image);
        $message->commit();

        return $message;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
