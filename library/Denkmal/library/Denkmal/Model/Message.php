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

    /**
     * @param string $clientId
     */
    public function setClientId($clientId) {
        $this->_set('clientId', $clientId);
    }

    /**
     * @return string
     */
    public function getClientId() {
        return $this->_get('clientId');
    }

    /**
     * @param Denkmal_Model_User $user
     */
    public function setUser($user) {
        $this->_set('user', $user);
    }

    /**
     * @return Denkmal_Model_User
     */
    public function getUser() {
        return $this->_get('user');
    }

    /**
     * @return Denkmal_ModelAsset_Tags
     */
    public function getTags() {
        return $this->_getAsset('Denkmal_ModelAsset_Tags');
    }

    public function toArrayApi(CM_Frontend_Render $render) {
        $array = array();
        $array['id'] = $this->getId();
        $array['venue'] = $this->getVenue()->getId();
        $array['created'] = $this->getCreated()->getTimestamp();
        $array['text'] = $this->getText();
        $array['image'] = $this->hasImage() ? $this->getImage()->toArrayApi($render) : null;
        return $array;
    }

    /**
     * @param CM_Frontend_Render $render
     * @return array
     */
    public function toArrayStream(CM_Frontend_Render $render) {
        $array = array();
        $array['id'] = $this->getId();
        $array['venue'] = $this->getVenue()->toArrayApi($render);
        $array['created'] = $this->getCreated()->getTimestamp();
        $array['text'] = $this->getText();
        $array['image'] = $this->hasImage() ? $this->getImage()->toArrayApi($render) : null;
        $array['tagList'] = Functional\map($this->getTags()->getAll(), function (Denkmal_Model_Tag $tag) {
            return $tag->getLabel();
        });
        $array['user'] = $this->getUser() ? $this->getUser()->toArray() : null;
        return $array;
    }

    protected function _onDeleteBefore() {
        if ($image = $this->getImage()) {
            $this->setImage(null);
            $image->delete();
        }
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'venue'    => array('type' => 'Denkmal_Model_Venue'),
            'clientId' => array('type' => 'string'),
            'user'     => array('type' => 'Denkmal_Model_User', 'optional' => true),
            'text'     => array('type' => 'string', 'optional' => true),
            'created'  => array('type' => 'DateTime'),
            'image'    => array('type' => 'Denkmal_Model_MessageImage', 'optional' => true),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        $containingCacheables[] = new Denkmal_Paging_Message_All();
        $containingCacheables[] = new Denkmal_Paging_Message_Venue($this->getVenue());
        $containingCacheables[] = new Denkmal_Paging_Message_Region($this->getVenue()->getRegion());
        return $containingCacheables;
    }

    protected function _getAssets() {
        return [
            new Denkmal_ModelAsset_Tags($this),
        ];
    }

    /**
     * @param Denkmal_Model_Venue             $venue
     * @param string                          $clientId
     * @param Denkmal_Model_User              $user
     * @param string|null                     $text
     * @param Denkmal_Model_MessageImage|null $image
     * @param DateTime|null                   $created
     * @throws CM_Exception_Invalid
     * @return Denkmal_Model_Message
     */
    public static function create(Denkmal_Model_Venue $venue, $clientId, Denkmal_Model_User $user = null, $text = null, Denkmal_Model_MessageImage $image = null, DateTime $created = null) {
        if (null === $created) {
            $created = new DateTime();
        }

        $message = new self();
        $message->setVenue($venue);
        $message->setClientId($clientId);
        $message->setUser($user);
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
