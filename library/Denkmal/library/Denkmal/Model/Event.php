<?php

class Denkmal_Model_Event extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

	const TYPE = 101;

	/**
	 * @return Denkmal_Model_Venue
	 */
	public function getVenue() {
		$venueId = $this->_get('venueId');
		return new Denkmal_Model_Venue($venueId);
	}

	/**
	 * @param Denkmal_Model_Venue $venue
	 */
	public function setVenue(Denkmal_Model_Venue $venue) {
		CM_Db_Db::update('denkmal_event', array('venueId' => $venue->getId()), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return DateTime
	 */
	public function getFrom() {
		$date = new DateTime();
		$date->setTimestamp($this->_get('from'));
		return $date;
	}

	/**
	 * @param DateTime $from
	 */
	public function setFrom(DateTime $from) {
		CM_Db_Db::update('denkmal_event', array('from' => $from->getTimestamp()), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return DateTime|null
	 */
	public function getUntil() {
		$until = $this->_get('until');
		if (null === $until) {
			return null;
		}
		$date = new DateTime();
		$date->setTimestamp($until);
		return $date;
	}

	/**
	 * @param DateTime|null $until
	 */
	public function setUntil(DateTime $until = null) {
		$until = isset($until) ? $until->getTimestamp() : null;
		CM_Db_Db::update('denkmal_event', array('until' => $until), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return (string) $this->_get('description');
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$description = (string) $description;
		CM_Db_Db::update('denkmal_event', array('description' => $description), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return string|null
	 */
	public function getTitle() {
		$title = $this->_get('title');
		if (null === $title) {
			return null;
		}
		return (string) $title;
	}

	/**
	 * @param string|null $title
	 */
	public function setTitle($title) {
		$title = isset($title) ? (string) $title : null;
		CM_Db_Db::update('denkmal_event', array('title' => $title), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return Denkmal_Model_Song|null
	 */
	public function getSong() {
		$songId = $this->_get('songId');
		if (null === $songId) {
			return null;
		}
		return new Denkmal_Model_Song($songId);
	}

	/**
	 * @param Denkmal_Model_Song $song
	 */
	public function setSong(Denkmal_Model_Song $song = null) {
		$songId = isset($song) ? (int) $song->getId() : null;
		CM_Db_Db::update('denkmal_event', array('songId' => $songId), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getQueued() {
		return (boolean) $this->_get('queued');
	}

	/**
	 * @param boolean $queued
	 */
	public function setQueued($queued) {
		$queued = (boolean) $queued;
		CM_Db_Db::update('denkmal_event', array('queued' => $queued), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getEnabled() {
		return (boolean) $this->_get('enabled');
	}

	/**
	 * @param boolean $enabled
	 */
	public function setEnabled($enabled) {
		$enabled = (boolean) $enabled;
		CM_Db_Db::update('denkmal_event', array('enabled' => $enabled), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getHidden() {
		return (boolean) $this->_get('hidden');
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden) {
		$hidden = (boolean) $hidden;
		CM_Db_Db::update('denkmal_event', array('hidden' => $hidden), array('id' => $this->getId()));
		$this->_change();
	}

	/**
	 * @return boolean
	 */
	public function getStarred() {
		return (boolean) $this->_get('starred');
	}

	/**
	 * @param boolean $starred
	 */
	public function setStarred($starred) {
		$starred = (boolean) $starred;
		CM_Db_Db::update('denkmal_event', array('starred' => $starred), array('id' => $this->getId()));
		$this->_change();
	}

	public function toArrayApi(CM_Render $render) {
		$array = array();
		$array['id'] = $this->getId();
		$array['description'] = $this->getDescription();
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

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_event', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected function _onDelete() {
		CM_Db_Db::delete('denkmal_event', array('id' => $this->getId()));
	}

	protected static function _create(array $data) {
		$data = Denkmal_Params::factory($data);

		$venue = $data->getVenue('venue');
		$from = $data->getDateTime('from')->getTimestamp();
		$until = $data->has('until') ? $data->getDateTime('until')->getTimestamp() : null;
		$description = $data->getString('description');
		$title = $data->has('title') ? $data->getString('title') : null;
		$song = $data->has('song') ? $data->getSong('song') : null;
		$queued = $data->getBoolean('queued');
		$enabled = $data->getBoolean('enabled');
		$hidden = $data->getBoolean('hidden', false);
		$star = $data->getBoolean('starred', false);

		$songId = isset($song) ? $song->getId() : null;

		$id = CM_Db_Db::insert('denkmal_event', array(
			'venueId'     => $venue->getId(),
			'from'        => $from,
			'until'       => $until,
			'title'       => $title,
			'description' => $description,
			'songId'      => $songId,
			'queued'      => $queued,
			'enabled'     => $enabled,
			'hidden'      => $hidden,
			'starred'     => $star,
		));

		return new static($id);
	}
}
