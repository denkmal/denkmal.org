<?php

class Denkmal_Model_Venue extends CM_Model_Abstract {

	const TYPE = 100;

	protected function _loadData() {
		return CM_Db_Db::select('denkmal_venue', array('*'), array('id' => $this->getId()))->fetch();
	}

	protected static function _create(array $data) {
		$data = CM_Params::factory($data);

		$name = $data->getString('name');
		$url = $data->has('url') ? $data->getString('url') : null;
		$address = $data->has('address') ? $data->getString('address') : null;
		$latitude = $data->has('latitude') ? $data->getFloat('latitude') : null;
		$longitude = $data->has('longitude') ? $data->getFloat('longitude') : null;
		$queued = $data->getBoolean('queued');
		$enabled = $data->getBoolean('enabled');
		$hidden = $data->getBoolean('hidden', false);
		$source = $data->has('source') ? $data->getInt('source') : null;

		$id = CM_Db_Db::insert('denkmal_venue', array(
			'name'      => $name,
			'url'       => $url,
			'address'   => $address,
			'latitude'  => $latitude,
			'longitude' => $longitude,
			'queued'    => $queued,
			'enabled'   => $enabled,
			'hidden'    => $hidden,
			'source'    => $source,
		));

		return new static($id);
	}
}
