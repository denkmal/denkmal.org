<?php

class Denkmal_Model_EventLink extends CM_Model_Abstract {

    /**
     * @return Denkmal_Model_Event
     */
    public function getEvent() {
        return $this->_get('event');
    }

    /**
     * @param Denkmal_Model_Event $event
     */
    public function setEvent(Denkmal_Model_Event $event) {
        $this->_set('event', $event);
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->_get('label');
    }

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->_set('label', $label);
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->_get('url');
    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->_set('url', $url);
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'event' => array('type' => 'Denkmal_Model_Event'),
            'label' => array('type' => 'string'),
            'url'   => array('type' => 'string'),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        $containingCacheables[] = new Denkmal_Paging_EventLink_Event($this->getEvent());
        return $containingCacheables;
    }

    /**
     * @param Denkmal_Model_Event $event
     * @param string              $label
     * @param string              $url
     * @return Denkmal_Model_EventLink
     */
    public static function create(Denkmal_Model_Event $event, $label, $url) {
        $link = new self();
        $link->setEvent($event);
        $link->setLabel($label);
        $link->setUrl($url);
        $link->commit();
        return $link;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
