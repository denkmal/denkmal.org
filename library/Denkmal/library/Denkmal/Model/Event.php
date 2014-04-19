<?php

class Denkmal_Model_Event extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

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

    /**
     * @return DateTime
     */
    public function getFrom() {
        /** @var DateTime $date */
        $date = $this->_get('from');
        $date->setTimezone($this->getTimeZone());
        return $date;
    }

    /**
     * @param DateTime $from
     */
    public function setFrom(DateTime $from) {
        $this->_set('from', $from);
    }

    /**
     * @return DateTime|null
     */
    public function getUntil() {
        /** @var DateTime $date */
        $date = $this->_get('until');
        if ($date) {
            $date->setTimezone($this->getTimeZone());
        }
        return $date;
    }

    /**
     * @param DateTime|null $until
     */
    public function setUntil(DateTime $until = null) {
        $this->_set('until', $until);
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->_get('description');
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->_set('description', $description);
    }

    /**
     * @return string|null
     */
    public function getTitle() {
        return $this->_get('title');
    }

    /**
     * @param string|null $title
     */
    public function setTitle($title) {
        $this->_set('title', $title);
    }

    /**
     * @return Denkmal_Model_Song|null
     */
    public function getSong() {
        return $this->_get('song');
    }

    /**
     * @param Denkmal_Model_Song $song
     */
    public function setSong(Denkmal_Model_Song $song = null) {
        $this->_set('song', $song);
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
    public function getEnabled() {
        return $this->_get('enabled');
    }

    /*
     * @param boolean $enabled
     */
    public function setEnabled($enabled) {
        $this->_set('enabled', $enabled);
    }

    /**
     * @return boolean
     */
    public function getHidden() {
        return $this->_get('hidden');
    }

    /**
     * @param boolean $hidden
     */
    public function setHidden($hidden) {
        $this->_set('hidden', $hidden);
    }

    /**
     * @return boolean
     */
    public function getStarred() {
        return $this->_get('starred');
    }

    /**
     * @return DateTimeZone
     */
    public function getTimeZone() {
        return CM_Bootloader::getInstance()->getTimeZone();
    }

    /**
     * @return Denkmal_Paging_Song_Search|null
     */
    public function getSongListSuggested() {
        $text = $this->getDescription();
        $searchTermList = array();

        foreach (Denkmal_Usertext_Filter_Links::getReplacements() as $replacement) {
            if (false === stripos($text, $replacement['label'])) {
                continue;
            }
            if (preg_match($replacement['search'], $text)) {
                $searchTermList[] = $replacement['label'];
            }
        }

        $searchTermList = array_unique(array_filter($searchTermList));

        if (empty($searchTermList)) {
            return null;
        }
        return new Denkmal_Paging_Song_Search($searchTermList);
    }

    /**
     * @param boolean $starred
     */
    public function setStarred($starred) {
        $this->_set('starred', $starred);
    }

    public function toArrayApi(CM_Render $render) {
        $array = array();
        $array['id'] = $this->getId();
        $array['venue'] = $this->getVenue()->getId();
        $array['description'] = $this->getDescription();
        if ($title = $this->getTitle()) {
            $array['title'] = $title;
        }
        $array['from'] = $this->getFrom()->getTimestamp();
        if ($until = $this->getUntil()) {
            $array['until'] = $until->getTimestamp();
        }
        $array['starred'] = $this->getStarred();
        if ($song = $this->getSong()) {
            $array['song'] = $song->toArrayApi($render);
        }
        return $array;
    }

    /**
     * @param Denkmal_Model_Venue     $venue
     * @param string                  $description
     * @param boolean                 $enabled
     * @param boolean                 $queued
     * @param DateTime                $from
     * @param DateTime|null           $until
     * @param string|null             $title
     * @param Denkmal_Model_Song|null $song
     * @param boolean|null            $hidden
     * @param boolean|null            $starred
     * @return Denkmal_Model_Event
     */
    public static function create($venue, $description, $enabled, $queued, $from, $until = null, $title = null, $song = null, $hidden = null, $starred = null) {
        $event = new self();
        $event->setVenue($venue);
        $event->setDescription($description);
        $event->setEnabled($enabled);
        $event->setQueued($queued);
        $event->setFrom($from);
        $event->setUntil($until);
        $event->setTitle($title);
        $event->setSong($song);
        $event->setHidden((boolean) $hidden);
        $event->setStarred((boolean) $starred);
        $event->commit();
        return $event;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'venue'       => array('type' => 'Denkmal_Model_Venue'),
            'from'        => array('type' => 'DateTime'),
            'until'       => array('type' => 'DateTime', 'optional' => true),
            'title'       => array('type' => 'string', 'optional' => true),
            'description' => array('type' => 'string'),
            'song'        => array('type' => 'Denkmal_Model_Song', 'optional' => true),
            'queued'      => array('type' => 'boolean'),
            'enabled'     => array('type' => 'boolean'),
            'hidden'      => array('type' => 'boolean'),
            'starred'     => array('type' => 'boolean'),
        ));
    }
}
